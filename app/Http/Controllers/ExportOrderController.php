<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Storage;
use Illuminate\Support\Facades\DB;

class ExportOrderController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    public function exportPdf()
    {
        $row = array();

        $row = DB::table('invoices')->select('invoice_number', 'name', 'no_table', 'payment_charge', 'payment_at', 'payment_status')
            ->get()->toArray();

        view()->share('row', $row);
        $pdf = PDF::loadView('invoices.orders', $row);
        $content = $pdf->download()->getOriginalContent();
        $name = \Str::random(20);
        Storage::disk('public')->put("orders/$name.pdf", $content);

        $filePath = storage_path("app/public/orders/{$name}.pdf");

        return response()->download($filePath, "Laporan Penjualan.pdf");
    }
}
