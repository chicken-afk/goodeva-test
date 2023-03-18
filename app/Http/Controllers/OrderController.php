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
            $row['products'] = DB::table('invoice_products')->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                ->select('invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                ->where('invoice_products.invoice_id', $invoice->id)
                ->get();

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
        $invoice = DB::table('invoices')->where('invoice_number', "INVC16786188091U")->first();
        $row['invoice'] = $invoice;
        $row['products'] = DB::table('invoice_products')->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
            ->select('invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
            ->where('invoice_products.invoice_id', $invoice->id)
            ->get();

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
        return view('main.order', compact('row'));
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
        $datas = DB::table('invoices')->where('order_status', '!=', 'selesai')->orderBy('order_at', 'asc')->get();

        foreach ($datas as $p => $q) {
            $invoice = $q;
            $row['products'] = DB::table('invoice_products')
                ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                ->select('outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                ->where('invoice_products.invoice_id', $invoice->id)
                ->get();

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

        $datas = DB::table('invoices')->where('order_status', '!=', 'selesai')->get();

        foreach ($datas as $k => $v) {
            $invoice = $v;
            $row['products'] = DB::table('invoice_products')
                ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                ->select('outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                ->where('invoice_products.invoice_id', $invoice->id)
                ->get();

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
            'total_data' => $datas->count()
        ]);
    }

    public function editStatus(Request $request)
    {
        DB::table('invoices')->where('invoice_number', $request->invoice)->update([
            'order_status' => $request->order_status,
            'updated_at' => now()
        ]);

        return response()->json([
            'status_code' => 200,
            'message' => 'berhasil merubah status',
            'order_status' => $request->order_status,
            'invoice' => $request->invoice
        ]);
    }
}
