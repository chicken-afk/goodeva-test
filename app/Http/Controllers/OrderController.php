<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function index(Request $request)
    {
        if ($request->has('invoice')) {
            $invoice = DB::table('invoices')->where('invoice_number', $request->invoice)->first();
            $row['invoice'] = $invoice;
            if (Auth::user()->role_id == 1) {
                $row['products'] = DB::table('invoice_products')->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->select('invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->get();
            } else {
                $row['products'] = DB::table('invoice_products')->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                    ->where('active_products.outlet_id', Auth::user()->outlet_id)
                    ->select('invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->get();
            }

            foreach ($row['products'] as $key => $value) {
                $variant = DB::table('invoice_product_variants')
                    ->join('variants', 'variants.id', 'invoice_product_variants.variant_id')
                    ->where('invoice_product_variants.invoice_product_variants', $value->id)
                    ->select('variants.varian_name')
                    ->first();
                $row['products'][$key]->varian_name = $variant ? $variant->varian_name : '';
                $toppings = DB::table('invoice_product_toppings')
                    ->join('toppings', 'toppings.id', 'invoice_product_toppings.topping_id')
                    ->where('invoice_product_toppings.invoice_product_id', $value->id)
                    ->select('toppings.topping_name')
                    ->get();
                $topping_text = "";
                foreach ($toppings as $k => $v) {
                    $topping_text = $topping_text . $v->topping_name . ", ";
                }
                $row['products'][$key]->topping_text = $topping_text;
            }

            return response()->json([
                'status_code' => 200,
                'data' => $row
            ]);
        }

        return view('main.order');
    }

    public function orderData(Request $request)
    {
        // return $request->all();
        $query = collect($request->query());
        $payment_status = [0, 1];
        $search = "";
        if (isset($query['query']['generalSearch'])) {
            $search = $query['query']['generalSearch'];
        }
        if (isset($query['query']['payment_status'])) {
            $payment_status = $query['query']['payment_status'] == '1' ? [1] : [0];
        }
        if (Auth::user()->role_id == 3) {
            $invoice = DB::table('invoices')->where('invoices.company_id', Auth::user()->company_id)
                ->select('invoices.id', 'invoices.invoice_number', 'invoices.payment_charge', 'invoices.name', 'invoices.no_table', 'invoices.order_at', 'invoices.payment_status', 'invoices.payment_at', 'invoices.order_status')
                ->orderByDesc('invoices.id')
                ->whereIn('invoices.payment_status', $payment_status)
                ->where('invoice_outlets.outlet_id', Auth::user()->outlet_id)
                ->join('invoice_outlets', 'invoice_outlets.invoice_id', 'invoices.id')
                ->where(function ($query) use ($search) {
                    $query->where('invoices.invoice_number', "LIKE", "%" . $search . "%")
                        ->orWhere('invoices.name', "LIKE", "%" . $search . "%")
                        ->orWhere('invoices.no_table', "LIKE", "%" . $search . "%");
                })
                ->get();
        } else {
            $invoice = DB::table('invoices')->where('company_id', Auth::user()->company_id)
                ->select('id', 'invoice_number', 'payment_charge', 'name', 'no_table', 'order_at', 'payment_status', 'payment_at', 'order_status')
                ->orderByDesc('id')
                ->whereIn('payment_status', $payment_status)
                ->where(function ($query) use ($search) {
                    $query->where('invoice_number', "LIKE", "%" . $search . "%")
                        ->orWhere('name', "LIKE", "%" . $search . "%")
                        ->orWhere('no_table', "LIKE", "%" . $search . "%");
                })
                ->get();
        }
        return response()->json([
            'status_code' => 200,
            'data' => $invoice
        ]);
    }

    public function payment(Request $request)
    {
        /**Validation Here */

        /**End Validation */

        $invoice = DB::table('invoices')->where('invoice_number', $request->invoice)->count();
        if ($invoice == 0) {
            return response()->json([
                'status_code' => 404,
                'message' => 'invoice tidak ditemukan'
            ]);
        }
        DB::table('invoices')->where('invoice_number', $request->invoice)->update([
            'payment_method' => $request->payment_method,
            'payment_change' => $request->payment_change,
            'payment_at' => now(),
            'payment_status' => 1
        ]);
        return response()->json([
            'status_code' => 200,
            'message' => 'payment success',
            'payment_method' => $request->payment_method,
            'payment_change' => $request->payment_change
        ]);
    }

    public function liveOrder()
    {
        if (Auth::user()->role_id != 1) {
            $datas = DB::table('invoices')
                ->join('invoice_outlets', 'invoice_outlets.invoice_id', 'invoices.id')
                ->where('invoices.order_status', '!=', 'selesai')
                ->where('invoice_outlets.order_status', '!=', 'selesai')
                ->orderBy('invoices.id', 'asc')
                ->where('invoice_outlets.outlet_id', Auth::user()->outlet_id)
                ->select('invoices.*', 'invoice_outlets.order_status as status_pemesanan')->get();
        } else {
            $datas = DB::table('invoices')->where('order_status', '!=', 'selesai')->select('invoices.*', 'invoices.order_status as status_pemesanan')->orderBy('id', 'asc')->get();
        }

        foreach ($datas as $p => $q) {
            $invoice = $q;
            if (Auth::user()->role_id != 1) {
                $row['products'] = DB::table('invoice_products')
                    ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->where('active_products.outlet_id', Auth::user()->outlet_id)
                    ->select('outlets.id as outlet_id', 'outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->get();
            } else {
                $row['products'] = DB::table('invoice_products')
                    ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                    ->select('outlets.id as outlet_id', 'outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->get();
            }

            foreach ($row['products'] as $key => $value) {
                $variant = DB::table('invoice_product_variants')
                    ->join('variants', 'variants.id', 'invoice_product_variants.variant_id')
                    ->where('invoice_product_variants.invoice_product_variants', $value->id)
                    ->select('variants.varian_name')
                    ->first();
                $row['products'][$key]->varian_name = $variant ? $variant->varian_name : '';
                $toppings = DB::table('invoice_product_toppings')
                    ->join('toppings', 'toppings.id', 'invoice_product_toppings.topping_id')
                    ->where('invoice_product_toppings.invoice_product_id', $value->id)
                    ->select('toppings.topping_name')
                    ->get();
                $topping_text = "";
                foreach ($toppings as $k => $v) {
                    $topping_text = $topping_text . $v->topping_name . ", ";
                }
                $row['products'][$key]->topping_text = $topping_text;
            }
            $datas[$p]->products = $row['products'];
        }

        return view('main.live-order', compact('datas'));
    }

    public function liveOrderData()
    {

        if (Auth::user()->role_id != 1) {
            $datas = DB::table('invoices')
                ->join('invoice_outlets', 'invoice_outlets.invoice_id', 'invoices.id')
                ->where('invoices.order_status', '!=', 'selesai')
                ->where('invoice_outlets.order_status', '!=', 'selesai')
                ->orderBy('invoices.id', 'asc')
                ->where('invoice_outlets.outlet_id', Auth::user()->outlet_id)
                ->select('invoices.*', 'invoice_outlets.order_status as status_pemesanan')->get();
        } else {
            $datas = DB::table('invoices')->where('order_status', '!=', 'selesai')->select('invoices.*', 'invoices.order_status as status_pemesanan')->orderBy('id', 'asc')->get();
        }

        foreach ($datas as $k => $v) {
            $invoice = $v;
            if (Auth::user()->role_id != 1) {
                $row['products'] = DB::table('invoice_products')
                    ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                    ->select('outlets.id as outlet_id', 'outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->where('active_products.outlet_id', Auth::user()->outlet_id)
                    ->get();
            } else {
                $row['products'] = DB::table('invoice_products')
                    ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                    ->select('outlets.id as outlet_id', 'outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->get();
            }

            foreach ($row['products'] as $key => $value) {
                $variant = DB::table('invoice_product_variants')
                    ->join('variants', 'variants.id', 'invoice_product_variants.variant_id')
                    ->where('invoice_product_variants.invoice_product_variants', $value->id)
                    ->select('variants.varian_name')
                    ->first();
                $row['products'][$key]->varian_name = $variant ? $variant->varian_name : '';
                $toppings = DB::table('invoice_product_toppings')
                    ->join('toppings', 'toppings.id', 'invoice_product_toppings.topping_id')
                    ->where('invoice_product_toppings.invoice_product_id', $value->id)
                    ->select('toppings.topping_name')
                    ->get();
                $topping_text = "";
                foreach ($toppings as $t => $i) {
                    $topping_text = $topping_text . $i->topping_name . ", ";
                }
                $row['products'][$key]->topping_text = $topping_text;
            }
            $datas[$k]->products = $row['products'];
        }



        return response()->json([
            'status_code' => 200,
            'datas' =>  $datas,
            'total_data' => $datas->count(),
            'user_id' => Auth::user()->id
        ]);
    }

    public function editStatus(Request $request)
    {
        $invoice = DB::table('invoices')->where('invoice_number', $request->invoice)->first();
        $user = DB::table('users')->where('id', $request->user_id)->first();
        // Check if user role is outlet
        if ($user->role_id != 1) {
            DB::table('invoice_outlets')->where('invoice_id', $invoice->id)->where('outlet_id', $user->outlet_id)->update([
                'order_status' => $request->order_status,
                'updated_at' => now()
            ]);
            /**Check if all outlet finish order */
            $cStatus = DB::table('invoice_outlets')->where('invoice_id', $invoice->id)->where(function ($query) {
                $query->where('order_status', '=', 'diterima')->orWhere('order_status', '=', 'diproses');
            })->count();
            if ($cStatus == 0) {
                DB::table('invoices')->where('invoice_number', $request->invoice)->update([
                    'order_status' => 'selesai',
                    'updated_at' => now()
                ]);
            }

            return response()->json([
                'status_code' => 200,
                'message' => 'berhasil merubah status',
                'order_status' => $request->order_status,
                'invoice' => $request->invoice
            ]);
        }
        DB::table('invoices')->where('invoice_number', $request->invoice)->update([
            'order_status' => $request->order_status,
            'updated_at' => now()
        ]);
        if ($request->order_status == 'selesai') {
            DB::table('invoice_outlets')->where('invoice_id', $invoice->id)->update([
                'order_status' => $request->order_status,
                'updated_at' => now()
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'berhasil merubah status',
            'order_status' => $request->order_status,
            'invoice' => $request->invoice
        ]);
    }
}
