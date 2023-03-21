@extends('master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('header-name')
    Statistik
@endsection
@section('menu-detail')
    Halaman Statistik Penjualan
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header h-auto">
                        <div class="card-title py-5">
                            <div class="card-label">
                                Statistik Penjualan Berdasarkan Omset
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart_1"></div>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header h-auto">
                        <div class="card-title py-5">
                            <div class="card-label">
                                Statistik Penjualan Berdasarkan Outlet
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart_2"></div>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header h-auto">
                        <div class="card-title py-5">
                            <div class="card-label">
                                Statistik Penjualan Berdasarkan Outlet
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart_11"></div>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header h-auto">
                        <div class="card-title py-5">
                            <div class="card-label">
                                Statistik Penjualan Berdasarkan Produk
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart_2"></div>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header h-auto">
                        <div class="card-title py-5">
                            <div class="card-label">
                                Statistik Penjualan Berdasarkan Produk
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart_12"></div>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('/js/pages/features/charts/apexcharts.js') }}"></script>
@endsection
