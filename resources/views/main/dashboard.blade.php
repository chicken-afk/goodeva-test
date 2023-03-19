@extends('master')
@section('header-name')
    Dashboard
@endsection
@section('content')
    <div class="container">
        @if (Auth::user()->role_id != 1)
            <div class="alert alert-danger mt-5">Anda Tidak Memiliki Akses ke Halaman ini</div>
        @else
        @endif
    </div>
@endsection
