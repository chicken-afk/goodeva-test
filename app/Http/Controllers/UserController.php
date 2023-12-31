<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class UserController extends Controller
{

    protected $company_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;

            return $next($request);
        });
    }

    public function view()
    {
        // dd('asdfs');
        $row['categories'] = DB::table('categories')->where('company_id', $this->company_id)->where('is_active', 1)->get();
        $row['outlets'] = DB::table('outlets')->join('active_products', 'active_products.outlet_id', 'outlets.id')->where('outlets.company_id', $this->company_id)->where('outlets.is_active', 1)->groupBy('outlets.id')->select('outlets.*')->get();
        foreach ($row['outlets'] as $key => $value) {
            $row['outlets'][$key]->products = DB::table('active_products')
                ->where('active_products.deleted_at', null)
                ->where('active_products.outlet_id', $value->id)
                ->where('active_products.company_id', $this->company_id)
                ->select('active_products.*')->get();
            foreach ($row['outlets'][$key]->products as $k => $v) {
                $row['outlets'][$key]->products[$k]->toppings = DB::table('toppings')->where('master_product_id', $v->id)->where('deleted_at', null)->get();
                $row['outlets'][$key]->products[$k]->varians = DB::table('variants')->where('master_product_id', $v->id)->where('deleted_at', null)->get();
            }
        }

        // dd($row);
        return view('users.dashboard', compact('row'));
    }

    public function carts()
    {
        return view('users.cart');
    }

    public function storeCart(Request $request)
    {
        // Validation

        // End Validation

        /**
         * Store Data Invoice
         */
        $totalPrice = $this->validatePrice($request);
        if ($totalPrice == false) {
            return response()->json([
                'status_code' => 422,
                'message' => 'Harga Beda'
            ], 422);
        }

        /** End Get Total Price */

        $invoice = "INVC" . time() . $this->company_id . strtoupper(Str::random(2));
        $invoiceToday = DB::table('invoices')->whereDate('created_at', Carbon::today())->count();
        $invoice_code = $invoiceToday + 1;
        /**Generate Tax */
        $tax = $totalPrice * 10 / 100;
        $pwithoutTax = $totalPrice;
        $totalPrice = $pwithoutTax + $tax;
        /**End Generate Tax */
        $invoiceId = DB::table('invoices')->insertGetId([
            'qr_code_id' => 0,
            'user_id' => Auth::id(),
            'invoice_number' => $invoice,
            'company_id' => $this->company_id,
            'invoice_code' => $invoice_code,
            'name' => $request->nama_pemesan,
            'keterangan' => $request->keterangan,
            'no_table' => $request->nomor_meja,
            'started_at' => now(),
            'order_at' => now(),
            'tax' => $tax,
            'charge_before_tax' => $pwithoutTax,
            'payment_charge' => $totalPrice,
            'created_at' => now(),
        ]);
        $outlets = array();
        $j = 0;
        foreach ($request->carts as $p => $q) {
            $q = collect($q);
            $product = DB::table('active_products')->where('uuid', $q['uuid'])->first();


            /**End insert invoice Outlets */

            $invoiceProductid = DB::table('invoice_products')->insertGetId([
                'invoice_id' => $invoiceId,
                'active_product_id' => $product->id,
                'qty' => $q['qty'],
                'notes' => $q['note'],
                'created_at' => now(),
                'price' => $q['price']
            ]);
            if ($q->has('varian_id')) {
                DB::table('invoice_product_variants')->insert([
                    'invoice_product_variants' => $invoiceProductid,
                    'active_product_id' => $product->id,
                    'variant_id' => $q['varian_id'],
                    'price' => $q['varian_price'],
                    'created_at' => now()
                ]);
            }
            if ($q->has('toppings')) {
                foreach ($q["toppings"] as $i => $j) {
                    DB::table('invoice_product_toppings')->insert([
                        'invoice_product_id' => $invoiceProductid,
                        'active_product_id' => $product->id,
                        'topping_id' => $j['topping_id'],
                        'price' => $j['topping_price'],
                        'created_at' => now()
                    ]);
                }
            }

            /**Insert invoice outlets */
            $inserted = DB::table('invoice_outlets')->where('invoice_id', $invoiceId)->where('outlet_id', $product->outlet_id)->count();
            if ($inserted == 0) {
                DB::table('invoice_outlets')->insert([
                    'invoice_id' => $invoiceId,
                    'outlet_id' => $product->outlet_id,
                    'created_at' => now()
                ]);
            }
        }

        /**
         * Generate Invoice For Each Outlet
         */
        $outlets = DB::table('invoice_outlets')->where('invoice_id', $invoiceId)->select('outlet_id')->get()->toArray();
        $invoice = DB::table('invoices')->where('id', $invoiceId)->first();
        //Groupping product peroutlets
        foreach ($outlets as $p => $q) {
            $q = collect($q);
            $index = 0;
            $outletId = $q['outlet_id'];
            foreach ($request->carts as $k => $v) {
                $v = collect($v);
                $product = DB::table('active_products')->where('uuid', $v['uuid'])->first();
                if ($q['outlet_id'] == $product->outlet_id) {
                    $topping_text = "";
                    $varian_name = "";
                    if ($v->has('varian_id')) {
                        $varian_name = "Varian : " . $v["varian_name"];
                    }
                    if ($v->has('toppings')) {
                        $topping_text = "topping : ";
                        foreach ($v['toppings']  as $topping) {
                            $topping_text = $topping_text . $topping['topping_name'] . ", ";
                        }
                    }
                    $outlets[$p]->products[$index] = array(
                        'varian_name' => $varian_name,
                        'topping_name' => $topping_text,
                        'product_name' => $v['product_name'],
                        'qty' => $v['qty'],
                        'notes' => $v['note'],
                        'total_price' => $v['price']
                    );
                    $index++;
                }
            }
            /**Create Invoice */
            $row['invoice_number'] = $invoice->invoice_number;
            $row['name'] = $invoice->name;
            $row['no_table'] = $invoice->no_table;
            $row['products'] = $outlets[$p]->products;
            $row['type'] = 'outlet';
            $row['keterangan'] = $request->keterangan;

            view()->share('row', $row);
            $pdf = PDF::loadView('invoices.invoice_print_satuan', $row)->setPaper([0, 0, 685.98, 215.772], 'landscape');
            $content = $pdf->download()->getOriginalContent();
            $name = \Str::random(20);
            Storage::disk('public')->put("invoices/$name.pdf", $content);
            /**Update PDF TO DB */
            DB::table('invoice_outlets')->where('outlet_id', $q['outlet_id'])->where('invoice_id', $invoice->id)->update([
                'invoice_pdf' => "/storage/invoices/$name.pdf",
                'updated_at' => now()
            ]);
        }


        return response()->json([
            'status_code' => 200,
            'invoice' => $invoice->invoice_number,
            'invoice_code' => $invoice_code,
            'outlets' => $outlets,
        ]);
    }

    public function invoice(Request $request)
    {
        if (!$request->has('invoice')) {
            abort(404);
        }

        $invoice = DB::table('invoices')->where('company_id', $this->company_id)->where('invoice_number', $request->invoice)->first();
        if (!$invoice) {
            abort(404);
        }


        $row['invoice'] = $invoice;

        $row['products'] = DB::table('invoice_products')->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
            ->select('invoice_products.id', 'invoice_products.notes', 'invoice_products.qty', 'invoice_products.price', 'invoice_products.active_product_id', 'active_products.active_product_name')
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

        // dd($row);
        return view('users.invoice', compact('row'));
    }

    /**
     * Function to validate if price from form input equals to on database
     */
    public function validatePrice($request)
    {
        $totalPrice = 0;
        foreach ($request->carts as $key => $value) {
            $value = collect($value);
            $priceItem = 0;
            $product = DB::table('active_products')->where('uuid', $value['uuid'])->first();
            if ($value->has('varian_id')) {
                $variants = DB::table('variants')->where('id', $value['varian_id'])->first();
                $priceItem += $variants->varian_price;
            } else {
                $priceItem += $product->price_promo;
            }
            /**Get Price Toppings */
            if ($value->has('toppings')) {
                foreach ($value['toppings'] as $i => $v) {
                    $topping = DB::table('toppings')->where('id', $v['topping_id'])->first();
                    $priceItem += $topping->topping_price;
                }
            }
            $priceItem = $priceItem * $value['qty'];
            $totalPrice += $priceItem;
        }

        if ($totalPrice != $request->invoice_charge) {
            /**Price isnt equal */
            return false;
        }
        /**Price Equals */
        return $totalPrice;
    }
}
