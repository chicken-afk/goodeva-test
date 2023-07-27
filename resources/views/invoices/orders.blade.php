<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>Invoice</td>
                <td>Nama</td>
                <td>Nomor Meja</td>
                <td>Total Pembayaran</td>
                <td>Tanggal Pemesanan</td>
                <td>Status Pembayaran</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($row as $value)
                <tr>
                    @php
                        $status_pembayaran = $value->payment_status == 1 ? 'Sudah Dibayar' : 'Belum Di bayar';
                    @endphp
                    <td>{{ $value->invoice_number }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->no_table }}</td>
                    <td>Rp. {{ $value->payment_charge }}</td>
                    <td>{{ $value->payment_at }}</td>
                    <td>
                        {{ $status_pembayaran }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
