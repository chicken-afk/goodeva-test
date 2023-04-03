<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class GenerateInvoice extends Controller
{
    public function generate()
    {
        $row['no_table'] = "INVC12345";
        $row['sub_total'] = 30000;
        $row['tax'] = 3000;
        $row['payment_charge'] = 33000;
        $row['invoice_number'] = "INVC12345";
        $row['name'] = "Andika";
        $row['products'] = array(
            array(
                'product_name' => "Nasi Goreng Spesial",
                'product_sku' => 'NASGOR2923',
                'product_qty' => '1',
                'total_price' => '39.000'
            ),
            array(
                'product_name' => "Es Teh",
                'product_sku' => 'ESTEH234',
                'product_qty' => '1',
                'total_price' => '5.000'
            ),
            array(
                'product_name' => "Americano",
                'product_sku' => 'AMRCN132',
                'product_qty' => '2',
                'total_price' => '22.000'
            )
        );
        return view('invoices.invoice_print', compact('row'));
        view()->share('row', $row);
        $pdf = PDF::loadView('invoices.invoice_print', $row);
        // download PDF file with download method
        return $pdf->download('pdf23_file.pdf');
    }
}
