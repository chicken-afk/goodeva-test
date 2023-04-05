<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{


    public function index(Request $request)
    {
        if ($request->has('invoice')) {
            $invoice = DB::table('invoices')->where('invoice_number', $request->invoice)->first();
            $row['invoice'] = $invoice;
            $row['products'] = DB::table('invoice_products')->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                ->select('invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name', 'active_products.product_image')
                ->where('invoice_products.invoice_id', $invoice->id)
                ->where('invoice_products.deleted_at', null)
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
                ->select('invoices.id', 'invoice_users.invoice_pdf', 'invoices.invoice_number', 'invoices.payment_charge', 'invoices.name', 'invoices.no_table', 'invoices.order_at', 'invoices.payment_status', 'invoices.payment_at', 'invoices.order_status')
                ->orderByDesc('invoices.id')
                ->whereIn('invoices.payment_status', $payment_status)
                ->where('invoice_outlets.outlet_id', Auth::user()->outlet_id)
                ->join('invoice_outlets', 'invoice_outlets.invoice_id', 'invoices.id')
                ->leftJoin('invoice_user_invoices', 'invoice_user_invoices.invoice_number', 'invoices.invoice_number')
                ->leftJoin('invoice_users', 'invoice_users.id', 'invoice_user_invoices.invoice_user_id')
                ->where(function ($query) use ($search) {
                    $query->where('invoices.invoice_number', "LIKE", "%" . $search . "%")
                        ->orWhere('invoices.name', "LIKE", "%" . $search . "%")
                        ->orWhere('invoices.no_table', "LIKE", "%" . $search . "%");
                })
                ->get();
        } else {
            $invoice = DB::table('invoices')->where('company_id', Auth::user()->company_id)
                ->select('invoices.id', 'invoice_users.invoice_pdf', 'invoices.invoice_number', 'invoices.payment_charge', 'invoices.name', 'invoices.no_table', 'invoices.order_at', 'invoices.payment_status', 'invoices.payment_at', 'invoices.order_status')
                ->orderByDesc('invoices.id')
                ->whereIn('invoices.payment_status', $payment_status)
                ->leftJoin('invoice_user_invoices', 'invoice_user_invoices.invoice_number', 'invoices.invoice_number')
                ->leftJoin('invoice_users', 'invoice_users.id', 'invoice_user_invoices.invoice_user_id')
                ->where(function ($query) use ($search) {
                    $query->where('invoices.invoice_number', "LIKE", "%" . $search . "%")
                        ->orWhere('invoices.name', "LIKE", "%" . $search . "%")
                        ->orWhere('invoices.no_table', "LIKE", "%" . $search . "%");
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

        $invoice = DB::table('invoices')->where('invoice_number', $request->invoice)->first();
        if (!$invoice) {
            return response()->json([
                'status_code' => 404,
                'message' => 'invoice tidak ditemukan'
            ]);
        }
        DB::table('invoices')->where('invoice_number', $request->invoice)->update([
            'payment_method' => $request->payment_method,
            'payment_change' => $request->payment_change,
            'payment_at' => now(),
            'payment_status' => 1,
            'order_status' => 'selesai'
        ]);

        /**Change All Order Proses to selesai */
        DB::table('invoice_outlets')->where('invoice_id', $invoice->id)->update([
            'order_status' => 'selesai',
            'updated_at' => now()
        ]);

        /**Generate Data For Invoices */
        $invoiceId = DB::table('invoice_users')->insertGetId([
            'user_id' => Auth::id(),
            'no_table' => $invoice->no_table,
            'payment_charge' => (int)$invoice->payment_charge,
            'tax' => ((int)$invoice->payment_charge / 1.1) * 0.1,
            'charge_before_tax' => (int)$invoice->payment_charge / 1.1,
            'created_at' => now()
        ]);
        DB::table('invoice_user_invoices')->insert([
            'invoice_user_id' => $invoiceId,
            'invoice_number' => $request->invoice,
            'created_at' => now()
        ]);

        $row['invoice'] = $invoice;
        $row['products'] = DB::table('invoice_products')->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
            ->select('invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name', 'active_products.product_image')
            ->where('invoice_products.invoice_id', $invoice->id)
            ->where('invoice_products.deleted_at', null)
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
            $row['products'][$key]->active_product_name = $row['products'][$key]->active_product_name . " " . $row['products'][$key]->varian_name . " " . $topping_text;
        }
        /**Create Invoice */
        $row['invoice_number'] = "INVC" . time();
        $row['name'] = $invoice->name;
        $row['no_table'] = $invoice->no_table;
        $row['payment_charge'] = $invoice->payment_charge;
        $row['sub_total'] = $invoice->charge_before_tax;
        $row['tax'] = $invoice->tax;

        view()->share('row', $row);
        $pdf = PDF::loadView('invoices.invoice_print_satuan', $row)->setPaper([0, 0, 685.98, 215.772], 'landscape');
        $content = $pdf->download()->getOriginalContent();
        $name = \Str::random(20);
        Storage::disk('public')->put("invoices/$name.pdf", $content);

        /**insert Invoice PDF */
        DB::table('invoice_users')->where('id', $invoiceId)->update([
            'invoice_pdf' => "/storage/invoices/$name.pdf",
            'updated_at' => now()
        ]);

        return response()->json([
            'status_code' => 200,
            'message' => 'payment success',
            'payment_method' => $request->payment_method,
            'payment_change' => $request->payment_change,
            'invoice_link' => "/storage/invoices/$name.pdf"
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
                    ->where('invoice_products.deleted_at', null)
                    ->select('outlets.id as outlet_id', 'outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->get();
            } else {
                $row['products'] = DB::table('invoice_products')
                    ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                    ->select('outlets.id as outlet_id', 'outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->where('invoice_products.deleted_at', null)
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
                    ->where('invoice_products.deleted_at', null)
                    ->where('active_products.outlet_id', Auth::user()->outlet_id)
                    ->get();
            } else {
                $row['products'] = DB::table('invoice_products')
                    ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->join('outlets', 'outlets.id', 'active_products.outlet_id')
                    ->select('outlets.id as outlet_id', 'outlets.outlet_name', 'invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->where('invoice_products.deleted_at', null)
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

    public function deleteProductInvoice($id)
    {
        $product = DB::table('invoice_products')->where('id', $id)->first();
        if (!$product) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Product Not Found'
            ], 404);
        }

        DB::table('invoice_products')->where('id', $id)->update([
            'deleted_at' => now()
        ]);

        //Generate New Total Price//
        $price = DB::table('invoice_products')->where('invoice_id', $product->invoice_id)->where('deleted_at', null)->sum('price');
        $tax = $price * 10 / 100;
        DB::table('invoices')->where('id', $product->invoice_id)->update([
            'tax' => $tax,
            'payment_charge' => $price + $tax,
            'charge_before_tax' => $price,
            'updated_at' => now()
        ]);
        $invoice = DB::table('invoices')->where('id', $product->invoice_id)->first();

        return response()->json([
            'status_code' => 200,
            'message' => 'Success Delete Product',
            'payment_charge' => $price + $tax,
            'invoice_number' => $invoice->invoice_number
        ], 200);
    }

    public function getInvoices(Request $request)
    {
        if ($request->has('no_table')) {
            $data['payment_charge'] = DB::table('invoices')->where('payment_status', 0)->where('no_table', $request->no_table)->sum('payment_charge');
            $data['name'] = DB::table('invoices')->where('payment_status', 0)->where('no_table', $request->no_table)->select('name')->pluck('name');
            $data['no_table'] = $request->no_table;
            $invoices = DB::table('invoices')->where('payment_status', 0)->where('no_table', $request->no_table)->get();
            foreach ($invoices as $index => $invoice) {
                $row['products'] = DB::table('invoice_products')->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
                    ->select('invoice_products.id', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name', 'active_products.product_image')
                    ->where('invoice_products.invoice_id', $invoice->id)
                    ->where('invoice_products.deleted_at', null)
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
                $invoices[$index]->products = $row['products'];
            }
            return response()->json([
                'status_code' => 200,
                'data' => $data,
                'invoices' => $invoices,
            ]);
        }
        abort(404);
    }

    public function paymentTable(Request $request)
    {
        $data = collect($request->data);
        $invoices = collect($request->invoices);
        /**Check Payment Money > Payment Charge */

        /**End Check */

        /**Generate Data For Invoices */
        $invoiceId = DB::table('invoice_users')->insertGetId([
            'user_id' => Auth::id(),
            'no_table' => $data['no_table'],
            'payment_charge' => (int)$data['payment_charge'],
            'tax' => ((int)$data['payment_charge'] / 1.1) * 0.1,
            'charge_before_tax' => (int)$data['payment_charge'] / 1.1,
            'created_at' => now()
        ]);

        /** Change Invoices Payment status to true */
        $i = 0;
        $product = array();
        foreach ($invoices as $key => $value) {
            $name = $value['name'];
            DB::table('invoices')->where('invoice_number', $value['invoice_number'])->update([
                'payment_method' => $data['payment_method'],
                'payment_change' => $data['payment_change'],
                'payment_at' => now(),
                'payment_status' => 1,
                'order_status' => 'selesai'
            ]);

            DB::table('invoice_user_invoices')->insert([
                'invoice_user_id' => $invoiceId,
                'invoice_number' => $value['invoice_number'],
                'created_at' => now()
            ]);

            /**Get Products List */
            foreach ($value['products'] as $k => $v) {
                $product[$i] =    array(
                    'product_name' => $v['active_product_name'] . " " . $v['varian_name'] . " " . $v['topping_text'],
                    'product_qty' => $v['qty'],
                    'total_price' => $v['price']
                );
                $i++;
            }
        }

        /**Create Invoice */
        $row['invoice_number'] = "INVC" . time();
        $row['name'] = $name;
        $row['no_table'] = $data['no_table'];
        $row['payment_charge'] = $data['payment_charge'];
        $row['sub_total'] = $data['payment_charge'] / 1.1;;
        $row['tax'] = $row['sub_total'] * 0.1;
        $row['products'] = $product;

        view()->share('row', $row);
        $pdf = PDF::loadView('invoices.invoice_print', $row)->setPaper([0, 0, 685.98, 215.772], 'landscape');
        $content = $pdf->download()->getOriginalContent();
        $name = \Str::random(20);
        Storage::disk('public')->put("invoices/$name.pdf", $content);

        /**insert Invoice PDF */
        DB::table('invoice_users')->where('id', $invoiceId)->update([
            'invoice_pdf' => "/storage/invoices/$name.pdf",
            'updated_at' => now()
        ]);

        return response()->json([
            'status_code' => 200,
            'message' => 'Pembayaran Berhasil',
            'invoice_link' => "/storage/invoices/$name.pdf"
        ]);
    }
}
