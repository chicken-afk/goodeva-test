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
}
