@extends('master')
@section('header-name')
    Dashboard
@endsection
@section('content')
    <div class="">
        @if (Auth::user()->role_id != 1)
            <div class="alert alert-danger mt-5">Anda Tidak Memiliki Akses ke Halaman ini</div>
        @else
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Dashboard-->
                    <div class="row">
                        <div class="col-xl-4">
                            <!--begin::List Widget 16-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">Pesanan Baru</h3>
                                    <div class="card-toolbar">
                                        <a href="{{ route('getOrders') }}">Lihat Semua</a>
                                    </div>
                                </div>
                                <!--end:Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2">
                                    <!--begin::Item-->
                                    @foreach ($row['invoices'] as $key => $value)
                                        <div class="d-flex flex-wrap align-items-center pb-10">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-50 symbol-2by3 flex-shrink-0 mr-4">
                                                <div class="symbol-label"
                                                    style="background-image: url('{{ $value->product_image }}')">
                                                </div>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                                                <a href="{{ route('getOrders') }}"
                                                    class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">{{ $value->invoice_number }}</a>
                                                <span class="text-muted font-weight-bold">{{ $value->name }}</span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Btn-->
                                            <a href="{{ route('getOrders') }}" class="btn btn-icon btn-light btn-sm">
                                                <span class="svg-icon svg-icon-success">
                                                    <span class="svg-icon svg-icon-md">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                <rect fill="#000000" opacity="0.3"
                                                                    transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                    x="11" y="5" width="2"
                                                                    height="14" rx="1"></rect>
                                                                <path
                                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </a>
                                            <!--end::Btn-->
                                        </div>
                                    @endforeach
                                    <!--end::Item-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 13-->
                        </div>
                        <div class="col-xl-8">
                            <!--begin::Mixed Widget 5-->
                            <div class="card card-custom bg-radial-gradient-primary gutter-b card-stretch">
                                <!--begin::Header-->
                                <div class="card-header border-0 py-5">
                                    <h3 class="card-title font-weight-bolder text-white">Sales Progress</h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column p-0" style="position: relative;">
                                    <!--begin::Chart-->
                                    {{-- <div id="kt_mixed_widget_5_chart" style="height: 200px; min-height: 200px;">
                                        <div id="apexchartsnyhtdt2q"
                                            class="apexcharts-canvas apexchartsnyhtdt2q apexcharts-theme-light"
                                            style="width: 343px; height: 200px;"><svg id="SvgjsSvg1156" width="343"
                                                height="200" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1158" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(20, 0)">
                                                    <defs id="SvgjsDefs1157">
                                                        <linearGradient id="SvgjsLinearGradient1161" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1162" stop-opacity="0.4"
                                                                stop-color="rgba(216,227,240,0.4)" offset="0">
                                                            </stop>
                                                            <stop id="SvgjsStop1163" stop-opacity="0.5"
                                                                stop-color="rgba(190,209,230,0.5)" offset="1">
                                                            </stop>
                                                            <stop id="SvgjsStop1164" stop-opacity="0.5"
                                                                stop-color="rgba(190,209,230,0.5)" offset="1">
                                                            </stop>
                                                        </linearGradient>
                                                        <clipPath id="gridRectMasknyhtdt2q">
                                                            <rect id="SvgjsRect1166" width="308" height="201"
                                                                x="-2.5" y="-0.5" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff">
                                                            </rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMasknyhtdt2q">
                                                            <rect id="SvgjsRect1167" width="307" height="204"
                                                                x="-2" y="-2" rx="0"
                                                                ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff">
                                                            </rect>
                                                        </clipPath>
                                                    </defs>
                                                    <rect id="SvgjsRect1165" width="6.492857142857142" height="200"
                                                        x="0" y="0" rx="0" ry="0"
                                                        opacity="1" stroke-width="0" stroke-dasharray="3"
                                                        fill="url(#SvgjsLinearGradient1161)"
                                                        class="apexcharts-xcrosshairs" y2="200" filter="none"
                                                        fill-opacity="0.9"></rect>
                                                    <g id="SvgjsG1187" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1188" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"></g>
                                                    </g>
                                                    <g id="SvgjsG1196" class="apexcharts-grid">
                                                        <g id="SvgjsG1197" class="apexcharts-gridlines-horizontal"
                                                            style="display: none;">
                                                            <line id="SvgjsLine1199" x1="0" y1="0"
                                                                x2="303" y2="0" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1200" x1="0" y1="20"
                                                                x2="303" y2="20" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1201" x1="0" y1="40"
                                                                x2="303" y2="40" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1202" x1="0" y1="60"
                                                                x2="303" y2="60" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1203" x1="0" y1="80"
                                                                x2="303" y2="80" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1204" x1="0" y1="100"
                                                                x2="303" y2="100" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1205" x1="0" y1="120"
                                                                x2="303" y2="120" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1206" x1="0" y1="140"
                                                                x2="303" y2="140" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1207" x1="0" y1="160"
                                                                x2="303" y2="160" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1208" x1="0" y1="180"
                                                                x2="303" y2="180" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1209" x1="0" y1="200"
                                                                x2="303" y2="200" stroke="#ecf0f3"
                                                                stroke-dasharray="4" class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG1198" class="apexcharts-gridlines-vertical"
                                                            style="display: none;"></g>
                                                        <line id="SvgjsLine1211" x1="0" y1="200"
                                                            x2="303" y2="200" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine1210" x1="0" y1="1"
                                                            x2="0" y2="200" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG1168"
                                                        class="apexcharts-bar-series apexcharts-plot-series">
                                                        <g id="SvgjsG1169" class="apexcharts-series" rel="1"
                                                            seriesName="NetxProfit" data:realIndex="0">
                                                            <path id="SvgjsPath1171"
                                                                d="M 15.15 200L 15.15 131.12321428571428Q 17.896428571428572 128.87678571428572 20.642857142857142 131.12321428571428L 20.642857142857142 131.12321428571428L 20.642857142857142 200L 20.642857142857142 200z"
                                                                fill="rgba(255,255,255,0.25)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 15.15 200L 15.15 131.12321428571428Q 17.896428571428572 128.87678571428572 20.642857142857142 131.12321428571428L 20.642857142857142 131.12321428571428L 20.642857142857142 200L 20.642857142857142 200z"
                                                                pathFrom="M 15.15 200L 15.15 200L 20.642857142857142 200L 20.642857142857142 200L 20.642857142857142 200L 15.15 200"
                                                                cy="130" cx="57.93571428571428" j="0"
                                                                val="35" barHeight="70"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1172"
                                                                d="M 58.43571428571428 200L 58.43571428571428 71.12321428571428Q 61.18214285714286 68.87678571428572 63.92857142857143 71.12321428571428L 63.92857142857143 71.12321428571428L 63.92857142857143 200L 63.92857142857143 200z"
                                                                fill="rgba(255,255,255,0.25)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 58.43571428571428 200L 58.43571428571428 71.12321428571428Q 61.18214285714286 68.87678571428572 63.92857142857143 71.12321428571428L 63.92857142857143 71.12321428571428L 63.92857142857143 200L 63.92857142857143 200z"
                                                                pathFrom="M 58.43571428571428 200L 58.43571428571428 200L 63.92857142857143 200L 63.92857142857143 200L 63.92857142857143 200L 58.43571428571428 200"
                                                                cy="70" cx="101.22142857142856" j="1"
                                                                val="65" barHeight="130"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1173"
                                                                d="M 101.72142857142856 200L 101.72142857142856 51.12321428571428Q 104.46785714285713 48.87678571428571 107.21428571428571 51.12321428571428L 107.21428571428571 51.12321428571428L 107.21428571428571 200L 107.21428571428571 200z"
                                                                fill="rgba(255,255,255,0.25)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 101.72142857142856 200L 101.72142857142856 51.12321428571428Q 104.46785714285713 48.87678571428571 107.21428571428571 51.12321428571428L 107.21428571428571 51.12321428571428L 107.21428571428571 200L 107.21428571428571 200z"
                                                                pathFrom="M 101.72142857142856 200L 101.72142857142856 200L 107.21428571428571 200L 107.21428571428571 200L 107.21428571428571 200L 101.72142857142856 200"
                                                                cy="50" cx="144.50714285714284" j="2"
                                                                val="75" barHeight="150"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1174"
                                                                d="M 145.00714285714284 200L 145.00714285714284 91.12321428571428Q 147.7535714285714 88.87678571428572 150.49999999999997 91.12321428571428L 150.49999999999997 91.12321428571428L 150.49999999999997 200L 150.49999999999997 200z"
                                                                fill="rgba(255,255,255,0.25)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 145.00714285714284 200L 145.00714285714284 91.12321428571428Q 147.7535714285714 88.87678571428572 150.49999999999997 91.12321428571428L 150.49999999999997 91.12321428571428L 150.49999999999997 200L 150.49999999999997 200z"
                                                                pathFrom="M 145.00714285714284 200L 145.00714285714284 200L 150.49999999999997 200L 150.49999999999997 200L 150.49999999999997 200L 145.00714285714284 200"
                                                                cy="90" cx="187.79285714285712" j="3"
                                                                val="55" barHeight="110"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1175"
                                                                d="M 188.29285714285712 200L 188.29285714285712 111.12321428571428Q 191.03928571428568 108.87678571428572 193.78571428571425 111.12321428571428L 193.78571428571425 111.12321428571428L 193.78571428571425 200L 193.78571428571425 200z"
                                                                fill="rgba(255,255,255,0.25)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 188.29285714285712 200L 188.29285714285712 111.12321428571428Q 191.03928571428568 108.87678571428572 193.78571428571425 111.12321428571428L 193.78571428571425 111.12321428571428L 193.78571428571425 200L 193.78571428571425 200z"
                                                                pathFrom="M 188.29285714285712 200L 188.29285714285712 200L 193.78571428571425 200L 193.78571428571425 200L 193.78571428571425 200L 188.29285714285712 200"
                                                                cy="110" cx="231.0785714285714" j="4"
                                                                val="45" barHeight="90"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1176"
                                                                d="M 231.5785714285714 200L 231.5785714285714 81.12321428571428Q 234.32499999999996 78.87678571428572 237.07142857142853 81.12321428571428L 237.07142857142853 81.12321428571428L 237.07142857142853 200L 237.07142857142853 200z"
                                                                fill="rgba(255,255,255,0.25)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 231.5785714285714 200L 231.5785714285714 81.12321428571428Q 234.32499999999996 78.87678571428572 237.07142857142853 81.12321428571428L 237.07142857142853 81.12321428571428L 237.07142857142853 200L 237.07142857142853 200z"
                                                                pathFrom="M 231.5785714285714 200L 231.5785714285714 200L 237.07142857142853 200L 237.07142857142853 200L 237.07142857142853 200L 231.5785714285714 200"
                                                                cy="80" cx="274.3642857142857" j="5"
                                                                val="60" barHeight="120"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1177"
                                                                d="M 274.8642857142857 200L 274.8642857142857 91.12321428571428Q 277.61071428571427 88.87678571428572 280.35714285714283 91.12321428571428L 280.35714285714283 91.12321428571428L 280.35714285714283 200L 280.35714285714283 200z"
                                                                fill="rgba(255,255,255,0.25)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 274.8642857142857 200L 274.8642857142857 91.12321428571428Q 277.61071428571427 88.87678571428572 280.35714285714283 91.12321428571428L 280.35714285714283 91.12321428571428L 280.35714285714283 200L 280.35714285714283 200z"
                                                                pathFrom="M 274.8642857142857 200L 274.8642857142857 200L 280.35714285714283 200L 280.35714285714283 200L 280.35714285714283 200L 274.8642857142857 200"
                                                                cy="90" cx="317.65" j="6"
                                                                val="55" barHeight="110"
                                                                barWidth="6.492857142857142"></path>
                                                        </g>
                                                        <g id="SvgjsG1178" class="apexcharts-series" rel="2"
                                                            seriesName="Revenue" data:realIndex="1">
                                                            <path id="SvgjsPath1180"
                                                                d="M 21.642857142857142 200L 21.642857142857142 121.12321428571428Q 24.389285714285712 118.87678571428572 27.135714285714286 121.12321428571428L 27.135714285714286 121.12321428571428L 27.135714285714286 200L 27.135714285714286 200z"
                                                                fill="rgba(255,255,255,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 21.642857142857142 200L 21.642857142857142 121.12321428571428Q 24.389285714285712 118.87678571428572 27.135714285714286 121.12321428571428L 27.135714285714286 121.12321428571428L 27.135714285714286 200L 27.135714285714286 200z"
                                                                pathFrom="M 21.642857142857142 200L 21.642857142857142 200L 27.135714285714286 200L 27.135714285714286 200L 27.135714285714286 200L 21.642857142857142 200"
                                                                cy="120" cx="64.42857142857143" j="0"
                                                                val="40" barHeight="80"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1181"
                                                                d="M 64.92857142857143 200L 64.92857142857143 61.12321428571428Q 67.675 58.87678571428571 70.42142857142858 61.12321428571428L 70.42142857142858 61.12321428571428L 70.42142857142858 200L 70.42142857142858 200z"
                                                                fill="rgba(255,255,255,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 64.92857142857143 200L 64.92857142857143 61.12321428571428Q 67.675 58.87678571428571 70.42142857142858 61.12321428571428L 70.42142857142858 61.12321428571428L 70.42142857142858 200L 70.42142857142858 200z"
                                                                pathFrom="M 64.92857142857143 200L 64.92857142857143 200L 70.42142857142858 200L 70.42142857142858 200L 70.42142857142858 200L 64.92857142857143 200"
                                                                cy="60" cx="107.71428571428571" j="1"
                                                                val="70" barHeight="140"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1182"
                                                                d="M 108.21428571428571 200L 108.21428571428571 41.12321428571428Q 110.96071428571427 38.87678571428571 113.70714285714286 41.12321428571428L 113.70714285714286 41.12321428571428L 113.70714285714286 200L 113.70714285714286 200z"
                                                                fill="rgba(255,255,255,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 108.21428571428571 200L 108.21428571428571 41.12321428571428Q 110.96071428571427 38.87678571428571 113.70714285714286 41.12321428571428L 113.70714285714286 41.12321428571428L 113.70714285714286 200L 113.70714285714286 200z"
                                                                pathFrom="M 108.21428571428571 200L 108.21428571428571 200L 113.70714285714286 200L 113.70714285714286 200L 113.70714285714286 200L 108.21428571428571 200"
                                                                cy="40" cx="150.99999999999997" j="2"
                                                                val="80" barHeight="160"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1183"
                                                                d="M 151.49999999999997 200L 151.49999999999997 81.12321428571428Q 154.24642857142854 78.87678571428572 156.9928571428571 81.12321428571428L 156.9928571428571 81.12321428571428L 156.9928571428571 200L 156.9928571428571 200z"
                                                                fill="rgba(255,255,255,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 151.49999999999997 200L 151.49999999999997 81.12321428571428Q 154.24642857142854 78.87678571428572 156.9928571428571 81.12321428571428L 156.9928571428571 81.12321428571428L 156.9928571428571 200L 156.9928571428571 200z"
                                                                pathFrom="M 151.49999999999997 200L 151.49999999999997 200L 156.9928571428571 200L 156.9928571428571 200L 156.9928571428571 200L 151.49999999999997 200"
                                                                cy="80" cx="194.28571428571425" j="3"
                                                                val="60" barHeight="120"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1184"
                                                                d="M 194.78571428571425 200L 194.78571428571425 101.12321428571428Q 197.53214285714282 98.87678571428572 200.27857142857138 101.12321428571428L 200.27857142857138 101.12321428571428L 200.27857142857138 200L 200.27857142857138 200z"
                                                                fill="rgba(255,255,255,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 194.78571428571425 200L 194.78571428571425 101.12321428571428Q 197.53214285714282 98.87678571428572 200.27857142857138 101.12321428571428L 200.27857142857138 101.12321428571428L 200.27857142857138 200L 200.27857142857138 200z"
                                                                pathFrom="M 194.78571428571425 200L 194.78571428571425 200L 200.27857142857138 200L 200.27857142857138 200L 200.27857142857138 200L 194.78571428571425 200"
                                                                cy="100" cx="237.57142857142853" j="4"
                                                                val="50" barHeight="100"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1185"
                                                                d="M 238.07142857142853 200L 238.07142857142853 71.12321428571428Q 240.8178571428571 68.87678571428572 243.56428571428566 71.12321428571428L 243.56428571428566 71.12321428571428L 243.56428571428566 200L 243.56428571428566 200z"
                                                                fill="rgba(255,255,255,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 238.07142857142853 200L 238.07142857142853 71.12321428571428Q 240.8178571428571 68.87678571428572 243.56428571428566 71.12321428571428L 243.56428571428566 71.12321428571428L 243.56428571428566 200L 243.56428571428566 200z"
                                                                pathFrom="M 238.07142857142853 200L 238.07142857142853 200L 243.56428571428566 200L 243.56428571428566 200L 243.56428571428566 200L 238.07142857142853 200"
                                                                cy="70" cx="280.85714285714283" j="5"
                                                                val="65" barHeight="130"
                                                                barWidth="6.492857142857142"></path>
                                                            <path id="SvgjsPath1186"
                                                                d="M 281.35714285714283 200L 281.35714285714283 81.12321428571428Q 284.1035714285714 78.87678571428572 286.84999999999997 81.12321428571428L 286.84999999999997 81.12321428571428L 286.84999999999997 200L 286.84999999999997 200z"
                                                                fill="rgba(255,255,255,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="square" stroke-width="1"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMasknyhtdt2q)"
                                                                pathTo="M 281.35714285714283 200L 281.35714285714283 81.12321428571428Q 284.1035714285714 78.87678571428572 286.84999999999997 81.12321428571428L 286.84999999999997 81.12321428571428L 286.84999999999997 200L 286.84999999999997 200z"
                                                                pathFrom="M 281.35714285714283 200L 281.35714285714283 200L 286.84999999999997 200L 286.84999999999997 200L 286.84999999999997 200L 281.35714285714283 200"
                                                                cy="80" cx="324.1428571428571" j="6"
                                                                val="60" barHeight="120"
                                                                barWidth="6.492857142857142"></path>
                                                        </g>
                                                        <g id="SvgjsG1170" class="apexcharts-datalabels"
                                                            data:realIndex="0"></g>
                                                        <g id="SvgjsG1179" class="apexcharts-datalabels"
                                                            data:realIndex="1"></g>
                                                    </g>
                                                    <line id="SvgjsLine1212" x1="0" y1="0"
                                                        x2="303" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1213" x1="0" y1="0"
                                                        x2="303" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1214" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG1215" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG1216" class="apexcharts-point-annotations"></g>
                                                </g>
                                                <g id="SvgjsG1195" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-18, 0)"></g>
                                                <g id="SvgjsG1159" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 100px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                                <div class="apexcharts-tooltip-title"
                                                    style="font-family: Poppins; font-size: 12px;"></div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(255, 255, 255);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Poppins; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(255, 255, 255);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Poppins; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!--end::Chart-->
                                    <!--begin::Stats-->
                                    <div class="card-spacer bg-white card-rounded flex-grow-1">
                                        <!--begin::Row-->
                                        <div class="row m-0 mb-2">
                                            <div class="col px-8 py-6 mr-8"
                                                style="background-color: rgb(201, 158, 133) ; border-radius : 15px;">
                                                <div class="font-size-sm font-weight-bold">Total Omset</div>
                                                <div class="font-size-h4 font-weight-bolder">Rp.
                                                    {{ number_format($row['omset']) }},-</div>
                                            </div>
                                            <div class="col px-8 py-6"
                                                style="background-color: rgb(203, 221, 153) ; border-radius : 15px;">
                                                <div class="font-size-sm font-weight-bold">
                                                    Penjualan Produk
                                                </div>
                                                <div class="font-size-h4 font-weight-bolder">
                                                    {{ $row['total_produk_terjual'] }}</div>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="row m-0">
                                            <div class="col px-8 py-6 mr-8"
                                                style="background-color: rgb(221, 153, 215) ; border-radius : 15px;">
                                                <div class="font-size-sm font-weight-bold">Produk Terlaris</div>
                                                <div class="font-size-h4 font-weight-bolder">
                                                    @if (count($row['produk_terlaris']) > 0)
                                                        {{ $row['produk_terlaris'][0]->active_product_name }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col px-8 py-6"
                                                style="background-color: rgb(153, 169, 221) ; border-radius : 15px;">
                                                <div class="font-size-sm font-weight-bold">Total invoice</div>
                                                <div class="font-size-h4 font-weight-bolder">{{ $row['total_invoice'] }}
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Stats-->
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 344px; height: 521px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Mixed Widget 5-->
                        </div>
                    </div>
                    <!--end::Row-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!--begin::Base Table Widget 2-->
                            <div class="card card-custom card-stretch gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Produk Terlaris</span>
                                        {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+
                                            Products</span> --}}
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2 pb-0 mt-n3">
                                    <div class="tab-content mt-5" id="myTabTables2">
                                        <!--begin::Tap pane-->
                                        <!--begin::Tap pane-->
                                        <div class="tab-pane fade show active" id="kt_tab_pane_2_3" role="tabpanel"
                                            aria-labelledby="kt_tab_pane_2_3">
                                            <!--begin::Table-->
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-vertical-center">
                                                    <thead>
                                                        <tr>
                                                            <th class="p-0" style="width: 50px"></th>
                                                            <th class="p-0" style="min-width: 150px"></th>
                                                            <th class="p-0" style="min-width: 140px"></th>
                                                            <th class="p-0" style="min-width: 120px"></th>
                                                            <th class="p-0" style="min-width: 40px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($row['produk_terlaris'] as $key => $value)
                                                            <tr>
                                                                <td class="pl-0 py-5">
                                                                    <div class="symbol symbol-50 symbol-light mr-2">
                                                                        <span class="symbol-label">
                                                                            <img src="{{ $value->product_image }}"
                                                                                class="h-50 align-self-center"
                                                                                alt="">
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td class="pl-0">
                                                                    <a href="#"
                                                                        class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->active_product_name }}</a>
                                                                    <span
                                                                        class="text-muted font-weight-bold d-block">{{ $value->sku }}</span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <span
                                                                        class="text-muted font-weight-bold">{{ $value->description }}</span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <span
                                                                        class="text-muted font-weight-bold">{{ $value->count }}
                                                                        Terjual</span>
                                                                </td>
                                                                <td class="text-right pr-0">
                                                                    <a href="{{ route('getProduct') }}"
                                                                        class="btn btn-icon btn-light btn-sm">
                                                                        <span
                                                                            class="svg-icon svg-icon-md svg-icon-success">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                width="24px" height="24px"
                                                                                viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1"
                                                                                    fill="none" fill-rule="evenodd">
                                                                                    <polygon points="0 0 24 0 24 24 0 24">
                                                                                    </polygon>
                                                                                    <rect fill="#000000" opacity="0.3"
                                                                                        transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                                        x="11" y="5"
                                                                                        width="2" height="14"
                                                                                        rx="1"></rect>
                                                                                    <path
                                                                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                                        fill="#000000" fill-rule="nonzero"
                                                                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                                                    </path>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            </tr>
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
                            <!--end::Base Table Widget 2-->
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--end::Dashboard-->
                </div>
                <!--end::Container-->
            </div>
        @endif
    </div>
@endsection
