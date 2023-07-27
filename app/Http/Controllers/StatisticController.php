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

    public function statisticProductMonthly()
    {
        $data = DB::table('invoices')
            ->where('invoices.payment_status', 1)
            ->join('invoice_products', 'invoice_products.invoice_id', 'invoices.id')
            ->join('active_products', 'active_products.id', 'invoice_products.active_product_id')
            ->select(
                'active_products.active_product_name',
                DB::raw('YEAR(invoices.created_at) as year'),
                DB::raw('Month(invoices.created_at) as month'),
                DB::raw('sum(invoice_products.qty) as `data`')
            )
            ->groupBy('active_products.active_product_name', 'year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $categories = [];
        $val = [];
        foreach ($data as $item) {
            $productName = $item->active_product_name;
            $year = $item->year;
            $month = $item->month;
            $qty = $item->data;

            $dateKey = "$month-$year";

            if (!isset($categories[$dateKey])) {
                $categories[$dateKey] = [
                    'date' => "$month-$year",
                ];
            }
        }

        // Ubah indeks numerik menjadi array asosiatif dengan kunci 'data'
        // Urutkan data berdasarkan tahun dan bulan (dari terlama ke terbaru)
        usort($categories, function ($a, $b) {
            $dateA = strtotime($a['date']);
            $dateB = strtotime($b['date']);

            return $dateA - $dateB;
        });

        $groupedData = [];
        foreach ($data as $item) {
            $productName = $item->active_product_name;
            $year = $item->year;
            $month = $item->month;
            $qty = $item->data;

            $dateKey = "$year-$month";

            if (!isset($groupedData[$productName])) {
                $groupedData[$productName] = [
                    'name' => $productName,
                    'data' => [],
                ];
            }

            $groupedData[$productName]['data'][] = $qty;
        }

        // Tampilkan hasil kelompokkan data dalam format yang diinginkan
        $finalGroupedData = [];
        foreach ($groupedData as $item) {
            $finalGroupedData[] = $item;
        }

        // Tampilkan hasil kelompokkan data


        $response['categories'] = $categories;
        $response['value'] = $finalGroupedData;
        return response()->json([
            'status_code' => 200,
            'data' => $response
        ]);
    }
}
