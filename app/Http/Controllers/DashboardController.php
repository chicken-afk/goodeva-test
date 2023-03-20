<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $row['invoices'] = DB::table('invoices')
            ->join('invoice_products', 'invoice_products.invoice_id', 'invoices.id')
            ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
            ->groupBy('invoices.id')
            ->where('invoices.payment_status', 0)
            ->orderByDesc('invoices.id')->limit(5)->get();
        $row['omset'] = DB::table('invoices')->where('payment_status', 1)->sum('payment_charge');
        $row['produk_terlaris'] = DB::table('invoice_products')
            ->join('invoices', 'invoices.id', '=', 'invoice_products.invoice_id')
            ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
            ->where('invoices.payment_status', 1)
            ->select('invoices.invoice_number', 'invoice_products.active_product_id', 'active_products.*', DB::raw("count(invoice_products.active_product_id) as count"))
            ->groupBy('invoice_products.active_product_id')
            ->get();
        $row['total_produk_terjual'] = DB::table('invoice_products')
            ->join('invoices', 'invoices.id', '=', 'invoice_products.invoice_id')
            ->where('invoices.payment_status', 1)
            ->sum('qty');
        $row['total_invoice'] = DB::table('invoices')->where('payment_status', 1)->count();

        $row['produk_terlaris'] =  $row['produk_terlaris']->sortByDesc('count')->values();
        // dd($row);
        return view('main.dashboard', compact('row'));
    }
}
