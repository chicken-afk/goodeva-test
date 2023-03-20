@extends('master')

@section('header-name')
    Profile Setting
@endsection
@section('menu-detail')
    Menu Mengelola Profile Information
@endsection

@section('content')
    <div class="container">
        <div class="flex-row-fluid">
            <!--begin::Card-->
            <div class="card card-custom card-stretch">
                <!--begin::Header-->
                <div class="card-header py-3">
                    <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
                    </div>

                    <form class="form" autocomplete="off" action="{{ route('saveSetting') }}" method="POST">
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                            {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                        </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <!--begin::Body-->
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Profile Info</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                value="{{ Auth::user()->name }}" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                value="{{ Auth::user()->email }}" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Role</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                value="{{ $row['users']->role_name }}" disabled>
                            <span class="form-text text-muted"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mt-10 mb-6">Password</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{-- <i class="la la-phone"></i> --}}
                                    </span>
                                </div>
                                <input type="password" class="form-control form-control-lg form-control-solid"
                                    name="new_password" placeholder="Password" autocomplete="off">
                            </div>
                            <span class="form-text text-muted">Insert Your New Password.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Password Confirmation</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{-- <i class="la la-phone"></i> --}}
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                    name="new_password_confirmation" placeholder="Password Confirmation" autocomplete="off">
                            </div>
                            <span class="form-text text-muted">Insert Your New Password.</span>
                        </div>
                    </div>

                </div>
                <!--end::Body-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection
