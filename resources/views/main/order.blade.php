@extends('master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .blink {
            animation: blinker 1s linear infinite;
            /* background: red; */
            /* color: white; */
            font-weight: bold;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>
@endsection
@section('header-name')
    Pesanan
@endsection
@section('menu-detail')
    Menu Mengelola Pesanan dan Pembayaran Pesanan
@endsection
@section('script')
    <script src="{{ asset('js/pages/custom/ecommerce/my-orders.js') . '?v=' . time() }}"></script>
@endsection

@section('content')
    @if (!Auth::user())
        <div class="alert alert-danger mt-5">Anda Tidak Memiliki Akses ke Halaman ini</div>
    @else
        <div class="container">
            <!--begin::Teachers-->
            <div class="d-flex flex-row">

                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder font-size-h3 text-dark">My Orders</span>
                                <span class="text-muted mt-1 font-weight-bold font-size-sm">Manage Orders</span>
                            </h3>
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <a href="{{ route('liveOrder') }}" target="_blank"
                                    class="btn btn-outline-danger font-weight-bolder">
                                    <span class="svg-icon svg-icon-md blink">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo4\dist/../src/media/svg/icons\Text\Dots.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1">
                                                <rect x="14" y="9" width="6" height="6"
                                                    rx="3" fill="black" />
                                                <rect x="3" y="9" width="6" height="6"
                                                    rx="3" fill="black" fill-opacity="0.7" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>Live Order</a>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin: Search Form-->
                            <!--begin::Search Form-->
                            <div class="mb-10">
                                <div class="row align-items-center">
                                    <div class="col-lg-9 col-xl-8">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control form-control-solid"
                                                        placeholder="Search..." id="kt_datatable_search_query" />
                                                    <span>
                                                        <i class="flaticon2-search-1 text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 my-2 my-md-0">
                                                <select class="form-control form-control-solid"
                                                    id="kt_datatable_search_status">
                                                    <option value="">Semua</option>
                                                    <option value="0">Belum Dibayar</option>
                                                    <option value="1">Sudah Dibayar</option>
                                                </select>
                                            </div>
                                            {{-- <div class="col-md-4 my-2 my-md-0">
                                            <select class="form-control form-control-solid" id="kt_datatable_search_type">
                                                <option value="">Type</option>
                                                <option value="4">Success</option>
                                                <option value="5">Info</option>
                                                <option value="6">Danger</option>
                                            </select>
                                        </div> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                    <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                </div> --}}
                                </div>
                            </div>
                            <!--end::Search Form-->
                            <!--end: Search Form-->
                            <!--begin: Datatable-->
                            <div class="datatable datatable-bordered datatable-head-custom table-responsive"
                                id="kt_datatable">
                            </div>
                            <!--end: Datatable-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Teachers-->
            <!-- Modal -->
            <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" id="modalContent">
                        {{-- Generate Content using jquery --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="closeModalDetail()">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>

        </div>
    @endif
@endsection
