<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        padding: 0.2rem 1rem 0.2rem 1rem;
    }

    h3 {
        font-size: large !important;
        text-align: center;
        margin-bottom: 3px;
        font-weight: 600;
    }

    h4 {
        font-size: xx-small;
        margin-top: 0px;
        text-align: center;
    }

    .line {
        height: 1px;
        background-color: white;
        margin-top: 3px;
        margin-bottom: 3px;
        border: 1px dashed black;
    }

    .invoice {
        font-size: x-small !important;
        font-weight: 600;
    }

    .products {
        font-size: x-small;
        text-transform: uppercase;
        font-weight: 600;
    }

    span {
        font-size: xx-small !important;
        font-weight: 600 !important;
    }

    .table {
        margin-bottom: 0px !important;
    }

    .table td,
    .table th {
        padding: 0rem !important;
        vertical-align: top;
        border-bottom: 1px solid #dee2e6 !important;
        border-top: none !important;
    }
</style>

<body>
    <h3>Warung Aceh Bang Ari</h3>
    <h4>Jl. Tebet Barat Dalam V
        No.1, RW.3, Tebet Bar., Kec. Tebet, Kota
        Jakarta Selatan,
        Daerah Khusus Ibukota Jakarta
        12810</h4>
    <div class="line"></div>
    <table>
        <tr>
            <td class="invoice">Invoice</td>
            <td class="invoice">:</td>
            <td class="invoice">{{ $row['invoice_number'] }}</td>
        </tr>
        <tr>
            <td class="invoice">Nama</td>
            <td class="invoice">:</td>
            <td class="invoice">{{ $row['name'] }}</td>
        </tr>
    </table>
    <div class="line"></div>
    @foreach ($row['products'] as $key => $value)
        <p class="products" style="margin-bottom: 2px">{{ $value['product_name'] }} <span>(Topping : Ayam)</span></p>
        <table class="products table">
            <tr>
                <td style="width: 140px">NASGOR389</td>
                <td style="width: 40px">2x</td>
                <td style="width: 90px">27.000</td>
                <td style="width: 40px;text-align: right">54.000</td>
            </tr>
        </table>
    @endforeach
    <div class="line"></div>
    <table class="table">
        <tr class="invoice">
            <td>Subtotal</td>
            <td>:</td>
            <td style="text-align: right">40.000</td>
        </tr>
        <tr class="invoice">
            <td>Pajak</td>
            <td>:</td>
            <td style="text-align: right">4.000</td>
        </tr>
        <tr class="invoice">
            <td>Total</td>
            <td>:</td>
            <td style="text-align: right">44.000</td>
        </tr>
    </table>
    <div class="line"></div>
    <p style="text-align: center; font-size : xx-small; font-weight : 600">21/03/2023 17:12:09</p>
</body>

</html>
