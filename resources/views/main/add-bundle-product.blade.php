@extends('master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="sweetalert2.min.css">
@endsection
@section('script')
    <script src="sweetalert2.min.js"></script>
    <script src="{{ asset('js/pages/custom/wizard/wizard-1.js') }}"></script>
    <script src="{{ asset('js/pages/crud/file-upload/dropzonejs.js') }}"></script>
    <script src="{{ asset('js/addproduct.js') }}"></script>
    <script>
        let token = `<?php echo csrf_token(); ?>`,
            data['_token'] = token;
        $(document).ready(function() {
            $("#submitButton").click(function() {
                console.log('masuk sini');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function postData() {
                    $.ajax({
                        url: `{{ route('postProduct') }}`,
                        type: "POST",
                        data: data,
                        success: function(response) {
                            Swal.fire(
                                'Good job!',
                                'Data Berhasil Disimpan!',
                                'success'
                            );
                            console.log(response)
                        },
                        error: function(response) {
                            console.log("Error gan")
                        }
                    });
                }
            });

        });
    </script>
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            @include('partials.masterdata.menu-2')
            <div class="flex-row-fluid ml-lg-12">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label text-uppercase text-dark-75">Buat Bundel
                            </h3>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row mg-lg-12">
                            <div class="col-sm-12 col-md-6 pl-15">
                                <span class="text-dark-75 font-weight-bolder font-size-base d-none d-md-inline">Bundel
                                    Detail</span>
                            </div>
                            <div class="col-sm-12 col-md-6 pl-15">
                                <span class="text-dark-75 font-weight-bolder font-size-base d-none d-md-inline">Bundel
                                    Produk</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
