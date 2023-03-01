@extends('master')
@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="d-flex flex-row">

            @include('partials.masterdata.menu')

            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-12">
        <!--end::Notice-->
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">List Products
                    <span class="d-block text-muted pt-2 font-size-sm">Initialized from remote json file</span></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-print"></i>
                                        </span>
                                        <span class="navi-text">Print</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-copy"></i>
                                        </span>
                                        <span class="navi-text">Copy</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i>
                                        </span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-text-o"></i>
                                        </span>
                                        <span class="navi-text">CSV</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    <a href="{{ route('addProductPage') }}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Tambah Data
                    </a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="kt_datatable_length"><label>Show <select name="kt_datatable_length" aria-controls="kt_datatable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="kt_datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="kt_datatable"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 1217px;">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 253px;" aria-sort="ascending" aria-label="Agent: activate to sort column descending">
                                Outlet
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 300px;" aria-label="Company Email: activate to sort column ascending">
                                Produk
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 124px;" aria-label="Company Agent: activate to sort column ascending">
                                SKU
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 194px;" aria-label="Company Name: activate to sort column ascending">
                                Deskripsi
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 38px;" aria-label="Type: activate to sort column ascending">
                                Harga
                            </th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 105px;" aria-label="Actions">
                                Harga Promo
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 58px;" aria-label="Status: activate to sort column ascending">
                                Stock
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 58px;" aria-label="Status: activate to sort column ascending">
                                Status
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 58px;" aria-label="Status: activate to sort column ascending">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr class="odd">
                            <td>Bakmi Aceh</td>
                            <td class="sorting_1 dtr-control" tabindex="0">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50 symbol-light-success">
                                        <div class="symbol-label font-size-h5">S</div>
                                    </div>
                                    <div class="ml-3">
                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">Spicy Chicken Bakmi</span>
                                        <a href="#" class="text-muted text-hover-primary">Makanan</a>
                                    </div>
                                </div>
                            </td>
                            <td>SPCICY102</td>
                            <td>Makanan renyah bikin gurih</td>
                            <td>Rp. 30.000,-</td>
                            <td>Rp. 25.000,-</td>
                            <td><span class="label label-lg font-weight-bold label-light-success label-inline">Ada</span></td>
                            <td><span class="label label-lg font-weight-bold label-light-success label-inline">Aktif</span></td>
                            <td nowrap="nowrap">	
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Details">								
                                    <i class="la la-eye"></i>							
                                </a>						
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">								
                                        <i class="la la-edit"></i>							
                                </a>							
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">								
                                        <i class="la la-trash"></i>							
                                </a>						
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row"><div class="col-sm-12 col-md-5">
            <div class="dataTables_info" id="kt_datatable_info" role="status" aria-live="polite">
            Showing 1 to 10 of 50 entries
        </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="kt_datatable_paginate">
                <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="kt_datatable_previous">
                        <a href="#" aria-controls="kt_datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="ki ki-arrow-back"></i></a>
                    </li>
                    <li class="paginate_button page-item active">
                        <a href="#" aria-controls="kt_datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="kt_datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                    </li>
                    <li>
                        <a href="#" aria-controls="kt_datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="ki ki-arrow-next"></i></a>                    </i>
                </ul>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
        </div>
    </div>
    </div>
    <!--end::Container-->
</div>
@endsection