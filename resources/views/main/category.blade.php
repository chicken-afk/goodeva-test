@extends('master')

@section('header-name')
    Kategori Produk
@endsection

@section('content')
    @if (Auth::user()->role_id != 1)
        <div class="alert alert-danger mt-5">Anda Tidak Memiliki Akses ke Halaman ini</div>
    @else
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            {{-- <!--begin::Subheader-->
    <div class="subheader py-5 py-lg-10 gutter-b subheader-transparent" id="kt_subheader" style="background-color: #663259; background-position: right bottom; background-size: auto 100%; background-repeat: no-repeat; background-image: url(assets/media/svg/patterns/taieri.svg)">
        <div class="container d-flex flex-column">
            <!--begin::Title-->
            <div class="d-flex align-items-sm-end flex-column flex-sm-row mb-5">
                <h2 class="d-flex align-items-center text-white mr-5 mb-0">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                Search Job</h2>
                <span class="text-white opacity-60 font-weight-bold">Job Management System</span>
            </div>
            <!--end::Title-->
            <!--begin::Search Bar-->
            <div class="d-flex align-items-md-center mb-2 flex-column flex-md-row">
                <div class="bg-white rounded p-4 d-flex flex-grow-1 flex-sm-grow-0">
                    <!--begin::Form-->
                    <form class="form d-flex align-items-md-center flex-sm-row flex-column flex-grow-1 flex-sm-grow-0">
                        <!--begin::Input-->
                        <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                            <span class="svg-icon svg-icon-lg">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <input type="text" class="form-control border-0 font-weight-bold pl-2" placeholder="Job Title">
                        </div>
                        <!--end::Input-->
                        <!--begin::Input-->
                        <span class="bullet bullet-ver h-25px d-none d-sm-flex mr-2"></span>
                        <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                            <span class="svg-icon svg-icon-lg">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <input type="text" class="form-control border-0 font-weight-bold pl-2" placeholder="Category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="kt_searchbar_7_category-options" data-offset="0,10" readonly="readonly">
                            <div id="kt_searchbar_7_category-options" class="dropdown-menu dropdown-menu-sm">
                                <div class="dropdown-item cursor-pointer">HR Management</div>
                                <div class="dropdown-item cursor-pointer">Developers</div>
                                <div class="dropdown-item cursor-pointer">Creative</div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item cursor-pointer">Top Management</div>
                            </div>
                        </div>
                        <!--end::Input-->
                        <!--begin::Input-->
                        <span class="bullet bullet-ver h-25px d-none d-sm-flex mr-2"></span>
                        <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                            <span class="svg-icon svg-icon-lg">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Rec.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z M12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C16.418278,4 20,7.581722 20,12 C20,16.418278 16.418278,20 12,20 Z" fill="#000000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <input id="kt_subheader_7_location" type="text" class="form-control border-0 font-weight-bold pl-2" placeholder="Location" data-toggle="modal" aria-haspopup="true" aria-expanded="false" data-target="#subheader7Modal" readonly="readonly">
                        </div>
                        <!--end::Input-->
                        <button type="submit" class="btn btn-dark font-weight-bold btn-hover-light-primary mt-3 mt-sm-0 px-7">Search</button>
                    </form>
                    <!--end::Form-->
                </div>
                <!--begin::Advanced Search-->
                <div class="mt-4 my-md-0 mx-md-10">
                    <a href="#" class="text-white font-weight-bolder text-hover-primary">Advanced Search</a>
                </div>
                <!--end::Advanced Search-->
            </div>
            <!--end::Search Bar-->
        </div>
    </div>
    <!--end::Subheader--> --}}

            <!--begin::Modal-->
            <div class="modal fade" id="subheader7Modal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Select Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="kt_subheader_leaflet" style="height:450px; width: 100%;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">Cancel</button>
                            <button id="submit" type="button" class="btn btn-primary font-weight-bold"
                                data-dismiss="modal">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Modal-->

            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container">
                    @include('partials.masterdata.menu-2')
                    <!--begin::Profile Overview-->
                    <div class="d-flex flex-row">

                        <!--begin::Content-->
                        <div class="flex-row-fluid ml-lg-12">
                            <!--end::Row-->
                            <!--begin::Advance Table: Widget 7-->
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Categories</span>
                                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Total Data :
                                            {{ $row['datas']->count() }}</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                                            <li class="nav-item">
                                                <!-- Button trigger modal-->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#addModal">
                                                    Tambah Data
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2 pb-0 mt-n3">
                                    <div class="tab-content mt-5" id="myTabTables12">

                                        <!--begin::Tap pane-->
                                        <div class="tab-pane fade show active" id="kt_tab_pane_12_3" role="tabpanel"
                                            aria-labelledby="kt_tab_pane_12_3">
                                            <!--begin::Table-->
                                            <div class="table-responsive">
                                                <table class="table table-separate table-head-custom table-checkable">
                                                    <thead>
                                                        <tr>
                                                            <th class="p-0 min-w-200px">Kategori Produk</th>
                                                            <th class="p-0 min-w-120px">Ditambahkan oleh</th>
                                                            <th class="p-0 min-w-120px">Status</th>
                                                            <th class="p-0 min-w-120px">Tanggal</th>
                                                            <th class="p-0 min-w-120px text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($row['datas'] as $key => $value)
                                                            <tr>
                                                                <td class="">
                                                                    <span
                                                                        class="font-weight-bold">{{ $value->category_name }}</span>
                                                                </td>
                                                                <td class="">
                                                                    <span
                                                                        class="font-weight-bold">{{ $value->name }}</span>
                                                                </td>
                                                                <td class="">
                                                                    @if ($value->is_active == 1)
                                                                        <span
                                                                            class="label label-lg label-light-primary label-inline">Aktif</span>
                                                                    @else
                                                                        <span
                                                                            class="label label-lg label-light-danger label-inline">Tidak
                                                                            aktif</span>
                                                                    @endif
                                                                </td>
                                                                <td class="">
                                                                    <span
                                                                        class="font-weight-bold">{{ date('d-M-Y H:i:s', strtotime($value->created_at)) }}</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button data-toggle="modal"
                                                                        data-target="#editModal{{ $value->id }}"
                                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                width="24px" height="24px"
                                                                                viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1"
                                                                                    fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0"
                                                                                        width="24" height="24">
                                                                                    </rect>
                                                                                    <path
                                                                                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                                        fill="#000000" fill-rule="nonzero"
                                                                                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                                                    </path>
                                                                                    <path
                                                                                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                                        fill="#000000" fill-rule="nonzero"
                                                                                        opacity="0.3"></path>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </button>


                                                                    <a href="{{ route('deleteCategory', $value->id) }}"
                                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                                        <span
                                                                            class="svg-icon svg-icon-md svg-icon-primary">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                width="24px" height="24px"
                                                                                viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1"
                                                                                    fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0"
                                                                                        width="24" height="24">
                                                                                    </rect>
                                                                                    <path
                                                                                        d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                                        fill="#000000"
                                                                                        fill-rule="nonzero">
                                                                                    </path>
                                                                                    <path
                                                                                        d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                                        fill="#000000" opacity="0.3">
                                                                                    </path>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            {{-- /Modal Edit --}}

                                                            <div class="modal fade" id="editModal{{ $value->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">
                                                                                Edit Kategori</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <i aria-hidden="true"
                                                                                    class="ki ki-close"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="card card-custom">
                                                                                <!--begin::Form-->
                                                                                <form
                                                                                    action="{{ route('updateCategory') }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="id"
                                                                                        value="{{ $value->id }}">
                                                                                    <div class="card-body">
                                                                                        <div class="form-group mb-8">
                                                                                            <div class="form-group">
                                                                                                <label>Nama Kategori<span
                                                                                                        class="text-danger">*</span></label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="category_name"
                                                                                                    value="{{ $value->category_name }}"
                                                                                                    placeholder="Enter Kategori Name"
                                                                                                    required />
                                                                                                <span
                                                                                                    class="form-text text-muted">Kategori
                                                                                                    produk, contoh :
                                                                                                    "Makanan",
                                                                                                    "Minuman",
                                                                                                    "Desert"</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--end::Form-->
                                                                                    </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-light-primary font-weight-bold"
                                                                                    data-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary font-weight-bold">Save
                                                                                    changes</button>

                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- End Modal Edit --}}
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Tap pane-->
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Advance Table Widget 7-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Profile Overview-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>


        {{-- Modal --}}
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-custom">
                            <!--begin::Form-->
                            <form action="{{ route('postCategory') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-8">
                                        <div class="form-group">
                                            <label>Nama Kategori<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="category_name"
                                                placeholder="Enter Kategori Name" required />
                                            <span class="form-text text-muted">Kategori produk, contoh : "Makanan",
                                                "Minuman",
                                                "Desert</span>
                                        </div>
                                    </div>
                                    <!--end::Form-->
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Save changes</button>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
    @endif
@endsection

@section('menu-detail')
    Menu Mengelola Kategori Produk
@endsection
