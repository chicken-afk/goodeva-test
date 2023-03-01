<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Services\RandomData;

class ProductController extends Controller
{

    public function index(RandomData $random) {
        $row['datas'] = DB::table('active_products')->get();

        return view('main.product', compact('row'));
    }

    public function store(Request $request, Random $random) {
        // Validator disini nanti

        // End Validator
        $uuid = $random->uuid('active_products');

        $mProductId = DB::table('master_product')->insertGetId([
            'outlet_id' => $request->outlet_id,
            'user_id' => 1,
            'company_id' => $request->company_id,
            'category_id' => $request->category_id,
            'product_name' => $request->productName,
            'description' => $request->productDescription,
            'product_image' => "Link image nanti dulu",
            "sku" => $request->productSKU,
            'price_display' => $request->productPrice,
            'price_promo' => $request->productPricePromo,
            'created_at' => now()
        ]);

        $insertProduct = DB::table('active_products')->insert([
            'uuid' => $uuid,
            'is_bundle' => 0,
            'active_product_name' => $request->productName,
            'product_image' => "Link image nanti dulu",
            "sku" => $request->productSKU,
            'price_display' => $request->productPrice,
            'price_promo' => $request->productPricePromo,
            'is_active' => 1,
            'is_available' => 1,
            'created_at' => now()
        ]);

        // Insert Varian
        foreach($request->varian as $value) {
            DB::table('variants')->insert([
                'master_product_id' => $mProductId,
                'user_id' => 1,
                'varian_name' => $value->varian_name,
                'varian_price' => $value->varian_price,
                'varian_sku' => $value->varian_sku,
                'varian_description' => 'null',
                'varian_promo' => $value->varian_price,
                'created_at' => now()
            ]);
        }
        // Insert Topping
        foreach($request->topping as $value) {
            DB::table('toppings')->insert([
                'topping_name' => $request->value->topping_name,
                'price' => $request->topping_price,
                'created_at' => now()
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'message' => "Berhasil Menambahkan Data"
        ], 200);
    }

    public function addProductPage() {
        $row['categories'] = DB::table('categories')->where('is_active', 1)->select('id', 'category_name')->get();
        $row['outlets'] = DB::table('outlets')->where('is_active', 1)->select('id', 'outlet_name')->get();
        return view('main.add-data-product', compact('row'));
    }


}
