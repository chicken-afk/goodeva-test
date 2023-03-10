@extends('users.main-cart')

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
            <div class="card-body">
                <div class="order-list">
                    <div class="d-flex bd-highlight">
                        <div class="bd-highlight pr-2 product-name">Nasi Goreng Ubed Special Sambal matah</div>
                        <div class="bd-highlight  ms-auto">
                            <img loading="lazy" src="{{ asset('storage/images/product/sXOLmDkUKvr0DVzi5P2n.png') }}"
                                class="rounded float-start thumbnail-product mini" alt="...">
                        </div>
                    </div>
                    <div class="d-flex bd-highlight mb-2">
                        <div class="bd-highlight pr-2">Flex item with</div>
                        <div class="bd-highlight ms-auto">Flex item</div>
                    </div>
                    <div class="line-1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer sticky-bottom">
        <button type="button" class="btn btn-sm btn-primary">
            Buat Pesanan</button>
    </div>
@endsection
