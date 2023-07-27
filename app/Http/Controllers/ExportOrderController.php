<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Storage;
use Illuminate\Support\Facades\DB;
use Str;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function importOrder(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $rows = Excel::toCollection(null, $file);
            $rows = $rows[0];
            foreach ($rows as $row) {
                $invoice_number = "INVC" . time() . Str::random(2);
                if (DB::table('invoices')->where('invoice_number', $invoice_number)->count() == 0) {
                    DB::table('invoices')->insert([
                        "invoice_code" => 1,
                        'invoice_number' => $invoice_number,
                        "no_table" => $row[5],
                        "name" => $row[6],
                        "keterangan" => $row[7],
                        "payment_at" => $row[8],
                        "payment_method" => $row[9],
                        "started_at" => $row[10],
                        "order_at" => $row[11],
                        "payment_charge" => $row[12],
                        "payment_change" => $row[13],
                        "payment_status" => $row[15],
                        "tax" => $row[23] ?? 0,
                        "charge_before_tax" => $row[24] ?? 0
                    ]);
                }
            }
            Alert::success('Success', 'Berhasil Menambah Data');
            return redirect()->back()->with('success', 'Data has been imported successfully.');
        }
        Alert::error('Error', 'Gagal Menambahkan Data');
        return redirect()->back()->with('error', 'Please choose a CSV file to import.');
    }
}
