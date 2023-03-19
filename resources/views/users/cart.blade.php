@extends('users.main-cart')

@section('js')
    <script src="{{ asset('users/js/cart.js') }}"></script>
@endsection
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('userPage') }}" class="back-button">
            <div class="back-button">
                <i class='bx bx-arrow-back'>kembali</i>
            </div>
        </a>
        <div class="card card-orders">
            <div class="card-header">
                <h4 class="title-orders">
                    <div class="child"> Daftar Pesanan <p>Periksa Kembali Pesanan Anda</p>
                    </div>
                    <div class="child-2 ms-auto">
                        <a href="{{ route('userPage') }}"><span>Tambah</span></a>
                    </div>

                </h4>
            </div>
            <div class="card-body mb-10" id="content-body">
                {{-- Append content using javascript --}}
            </div>
        </div>

        <div class="card card-orders" id="detailPemesan" style="margin-bottom : 100px !important;">
            <div class="card-header">
                <h4 class="title-orders">
                    <div class="child"> Detail Pemesan</div>
                </h4>
            </div>
            <div class="card-body detail-users">
                <div class="inpout-group mb-3">
                    <label for="">Nama Pemesan</label>
                    <p id="alert-user" class="d-none">Wajib Mengisi Nama</p>
                    <input id="nUser" type="text" class="form-control" placeholder="Nama Pemesan"
                        aria-label="Nama Pemesan" aria-describedby="basic-addon1" name="name" required>
                </div>
                <div class="inpout-group mb-3">
                    <label for="">Nomor Meja</label>
                    <p id='alert-table' class="d-none mb-0">Wajib Mengisi Nomor Meja</p>
                    <p>Input nomor yang ada di meja atau ambil nomor meja di kasir</p>
                    <input id="nTable" type="number" class="form-control" placeholder="Nomor Meja"
                        aria-label="Nomor Meja" aria-describedby="basic-addon1" name="table_no" required>
                </div>
            </div>
        </div>
    </div>

    <div class="footer sticky-bottom">
        <button onclick="submitOrders()" id="buttonCheckout" type="button" class="btn btn-sm btn-primary">
            {{-- Generate Using Javascript --}}
        </button>
    </div>
@endsection
