<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function view()
    {
        return view('main.statistic');
    }

    public function statisticOmset()
    {
        $datas = DB::table('invoices')->where('payment_status', 1)
            ->select(DB::raw('sum(payment_charge) as `omset`'), DB::raw("DATE_FORMAT(payment_at, '%M-%Y') new_date"),  DB::raw('YEAR(payment_at) year, MONTH(payment_at) month'))
            ->groupby('year', 'month')
            ->get();
        return response()->json([
            'status_code' => 200,
            'data' => $datas
        ]);
    }

    public function statisticOmsetDat(Request $request)
    {
        $datas = DB::table('invoices')->where('payment_status', 1)
            ->select(DB::raw('sum(payment_charge) as `omset`'), DB::raw("DATE_FORMAT(payment_at, '%d-%M-%Y') new_date"),  DB::raw('Day(payment_at) day'))
            ->groupby('day')
            ->get();
        return response()->json([
            'status_code' => 200,
            'data' => $datas
        ]);
    }

    public function statisticOutlet()
    {
        $datas = DB::table('invoices')->where('invoices.payment_status', 1)
            ->join('invoice_products', 'invoice_products.invoice_id', 'invoices.id')
            ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
            ->join('outlets', 'outlets.id', 'active_products.outlet_id')
            ->select('outlets.outlet_name', DB::raw('sum(invoice_products.qty) as `data`'))
            ->groupBy('outlets.id')
            ->get();
        $datas = $datas->sortByDesc('data')->values();
        return response()->json([
            'status_code' => 200,
            'data' => $datas
        ]);
    }
    public function statisticProduct()
    {
        $datas = DB::table('invoices')->where('invoices.payment_status', 1)
            ->join('invoice_products', 'invoice_products.invoice_id', 'invoices.id')
            ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
            ->select('active_products.active_product_name', DB::raw('sum(invoice_products.qty) as `data`'))
            ->groupBy('invoice_products.active_product_id')
            ->get();
        $datas = $datas->sortByDesc('data')->values();
        return response()->json([
            'status_code' => 200,
            'data' => $datas
        ]);
    }
}
