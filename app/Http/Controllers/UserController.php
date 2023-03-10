<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    protected int $company_id;

    public function __construct()
    {
        $this->company_id = 1;
    }

    public function view()
    {
        // dd('asdfs');
        $row['categories'] = DB::table('categories')->where('company_id', $this->company_id)->where('is_active', 1)->get();
        $row['outlets'] = DB::table('outlets')->where('company_id', $this->company_id)->where('is_active', 1)->get();
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
}
