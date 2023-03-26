<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('users/css/main.css') . '?v=' . time() }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="{{ asset('media/client-logos/logo.png') }}">
    <!--begin::Global Theme Styles(used by all pages)-->
    {{-- <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <title>Warung Aceh Bang Ari</title>
    @yield('css')
</head>

<body>

    {{-- Header Navbara --}}
    <div class="headers" id="header">
        <nav class="navbars container d-flex justify-content-center mt-2 mb-2">
            <a href="{{ route('userPage') }}" style="text-decoration: none !important">
                <div class="brand">
                    <img src="{{ asset('media/client-logos/logo.png') }}" class="logo-brand" />
                    Warung Aceh Bang Ari
                </div>
            </a>
        </nav>
        @yield('header-content')
    </div>
    {{-- End Header Navbar --}}
    {{-- <div class="product-wrap container"> --}}
    {{-- </div> --}}
    <div class="main-cart">
        <div class="container">
            <div class="card card-invoice">
                <div class="card-header">
                     <div class="d-flex justify-content-center mt-2 mb-2">
                    <div class="brand" style="margin: auto !important;">
                        <img src="{{ asset('media/client-logos/logo.png') }}" class="logo-brand" />
                        <span> Warung Aceh Bang Ari </span>
                    </div>
                    </div>
                    {{-- <h3 class="mt-3" style="font-size : large;">Pesanan Berhasil</h3> --}}
                    @php
                        $text_status = $row['invoice']->order_status == 'diterima' ? 'Pesanan sudah ' : 'Pesanan sedang ';
                    @endphp
                    <h4 class="mb-0 mt-3" style="font-size : medium;">{{ $text_status . $row['invoice']->order_status }}

                        <span class="text-primary" style="font-size : x-small ; text-decoration : none;"
                            onclick="location.reload();">(Check Status)</span>
                    </h4>
                    <p class="mb-0" style="font-size : smaller !important;">Pesanan akan langsung dibawa oleh pelayan
                        ke meja anda.
                    </p>
                </div>
                <div class="card-body">
                    <div style="display: grid;grid-template-columns: 1fr 0.1fr 1fr; grid-gap: 1px;">
                        <h5 class="mb-0" style="width: 7rem">Nama</h5>
                        <h5 class="mb-0" style="width: 0.1rem">:</h5>
                        <h5 class="mb-0">{{ $row['invoice']->name }}</h5>
                    </div>
                    <div style="display: grid;grid-template-columns: 1fr 0.1fr 1fr; grid-gap: 1px;">
                        <h5 class="mb-0" style="width: 7rem">Status Pembayaran</h5>
                        <h5 class="mb-0" style="width: 0.1rem">:</h5>
                        <h5 class="mb-0 text-danger">
                            {{ $row['invoice']->payment_status == 0 ? 'Belum dibayar' : 'Sudah dibayar' }}
                        </h5>
                    </div>
                    <div style="display: grid;grid-template-columns: 1fr 0.1fr 1fr; grid-gap: 1px;">
                        <h5 class="mb-0" style="width: 7rem">Kode Pemesanan</h5>
                        <h5 class="mb-0" style="width: 0.1rem">:</h5>
                        <h5 class="mb-0">{{ $row['invoice']->invoice_code }}</h5>
                    </div>
                    <div style="display: grid;grid-template-columns: 1fr 0.1fr 1fr; grid-gap: 1px;">
                        <h5 class="mb-0" style="width: 7rem">Invoice</h5>
                        <h5 class="mb-0" style="width: 0.1rem">:</h5>
                        <h5 class="mb-0">{{ $row['invoice']->invoice_number }}</h5>
                    </div>
                    <div style="display: grid;grid-template-columns: 1fr 0.1fr 1fr; grid-gap: 1px;">
                        <h5 class="mb-0" style="width: 7rem">Nomor Meja</h5>
                        <h5 class="mb-0" style="width: 0.1rem">:</h5>
                        <h5 class="mb-0"> {{ $row['invoice']->no_table }}</h5>
                    </div>
                    <div style="display: grid;grid-template-columns: 1fr 0.1fr 1fr; grid-gap: 1px;">
                        <h5 class="mb-1" style="width: 7rem">Harga</h5>
                        <h5 class="mb-1" style="width: 0.1rem">:</h5>
                        <h5 class="mb-1"> Rp. {{ number_format($row['invoice']->charge_before_tax) }},-</h5>
                    </div>
                    <div style="display: grid;grid-template-columns: 1fr 0.1fr 1fr; grid-gap: 1px;">
                        <h5 class="mb-1" style="width: 7rem">Pajak (10%)</h5>
                        <h5 class="mb-1" style="width: 0.1rem">:</h5>
                        <h5 class="mb-1"> Rp. {{ number_format($row['invoice']->tax) }},-</h5>
                    </div>
                    <div style="display: grid;grid-template-columns: 1fr 0.1fr 1fr; grid-gap: 1px;">
                        <h5 class="mb-1" style="width: 7rem">Harga Total</h5>
                        <h5 class="mb-1" style="width: 0.1rem">:</h5>
                        <h5 class="mb-1"> Rp. {{ number_format($row['invoice']->payment_charge) }},-</h5>
                    </div>
                    <h5 class="mb-0">Pesanan :</h5>
                    @foreach ($row['products'] as $key => $value)
                        <div class="line-1"></div>
                        <div class="order-list">
                            <div class="d-flex bd-highlight">
                                <div class="bd-highlight pr-2 product-name">
                                    {{ $value->active_product_name }}
                                    <p>Varian : {{ $value->varian_name }}</p>
                                    <p>Topping : {{ $value->topping_text }}</p>
                                </div>
                                <div class="bd-highlight  ms-auto" style="font-weight:500;font-size:1rem">
                                    <p style="font-size: 0.8rem">Qty : {{ $value->qty }}</p>
                                </div>
                            </div>
                            <div class="d-flex bd-highlight mb-2">
                                <div class="bd-highlight pr-2">
                                    <span class="price" id="price-${i}">Rp.
                                        {{ number_format($value->price * $value->qty) }},-</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-sm btn-danger mt-1" onclick="window.print()">Print
                        Invoice</button>
                    <input type="hidden"
                        value="{{ route('invoice', ['invoice' => $row['invoice']->invoice_number]) }}" name=""
                        id="myInput">
                    <button type="button" class="btn btn-sm btn-primary mt-1" onclick="copyLink()">
                        Share Invoice</button>
                    <a type="button" class="btn btn-sm btn-warning mt-1" href="{{ route('userPage') }}">
                        Pesan Lagi</a>
                </div>
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('users/js/main.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script> --}}
    {{-- <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyLink() {

            // Get the text field
            var copyText = document.getElementById("myInput");

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
    </script>

    @yield('js')
</body>

</html>
