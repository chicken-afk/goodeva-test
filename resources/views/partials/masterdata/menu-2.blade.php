<div class="row">
    <div class="col-xl-12">
        <!--begin::Nav Panel Widget 1-->
        <div class="card card-custom gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Nav Tabs-->
                <ul class="dashboard-tabs nav nav-pills nav-danger row row-paddingless m-0 p-0 flex-column flex-sm-row">
                    <!--begin::Item-->
                    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0 ">
                        <a href="{{ route('getProduct') }}"
                            class="{{ set_active(['addProductPage', 'getProduct', 'createBundlePage']) }} nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center">
                            <span class="nav-icon py-2 w-auto">
                                <span class="svg-icon svg-icon-3x">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24">
                                            </rect>
                                            <rect fill="#000000" x="4" y="4" width="7"
                                                height="7" rx="1.5"></rect>
                                            <path
                                                d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Products</span>
                        </a>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a href="{{ route('getCategory') }}"
                            class="{{ set_active('getCategory') }} nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center">
                            <span class="nav-icon py-2 w-auto">
                                <span class="svg-icon svg-icon-3x">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" opacity="0.3" x="4" y="4"
                                                width="4" height="4" rx="2" />
                                            <rect fill="#000000" x="4" y="10" width="4"
                                                height="4" rx="2" />
                                            <rect fill="#000000" x="10" y="4" width="4"
                                                height="4" rx="2" />
                                            <rect fill="#000000" x="10" y="10" width="4"
                                                height="4" rx="2" />
                                            <rect fill="#000000" x="16" y="4" width="4"
                                                height="4" rx="2" />
                                            <rect fill="#000000" x="16" y="10" width="4"
                                                height="4" rx="2" />
                                            <rect fill="#000000" x="4" y="16" width="4"
                                                height="4" rx="2" />
                                            <rect fill="#000000" x="10" y="16" width="4"
                                                height="4" rx="2" />
                                            <rect fill="#000000" x="16" y="16" width="4"
                                                height="4" rx="2" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Kategori</span>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a href="{{ route('getOutlets') }}"
                            class="{{ set_active('getOutlets') }} nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center">
                            <span class="nav-icon py-2 w-auto">
                                <span class="svg-icon svg-icon-3x">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M3,16 L21,16 C21,18.209139 19.209139,20 17,20 L7,20 C4.790861,20 3,18.209139 3,16 Z M3,11 L21,11 L21,12 C21,13.1045695 20.1045695,14 19,14 L5,14 C3.8954305,14 3,13.1045695 3,12 L3,11 Z"
                                                fill="#000000" />
                                            <path
                                                d="M3,5 L21,5 L21,7 C21,8.1045695 20.1045695,9 19,9 L5,9 C3.8954305,9 3,8.1045695 3,7 L3,5 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Outlets</span>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    {{-- <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-0 mb-3 mb-lg-0">
                        <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center">
                            <span class="nav-icon py-2 w-auto">
                                <span class="svg-icon svg-icon-3x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo4\dist/../src/media/svg/icons\Shopping\Barcode-scan.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M15,9 L13,9 L13,5 L15,5 L15,9 Z M15,15 L15,20 L13,20 L13,15 L15,15 Z M5,9 L2,9 L2,6 C2,5.44771525 2.44771525,5 3,5 L5,5 L5,9 Z M5,15 L5,20 L3,20 C2.44771525,20 2,19.5522847 2,19 L2,15 L5,15 Z M18,9 L16,9 L16,5 L18,5 L18,9 Z M18,15 L18,20 L16,20 L16,15 L18,15 Z M22,9 L20,9 L20,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,9 Z M22,15 L22,19 C22,19.5522847 21.5522847,20 21,20 L20,20 L20,15 L22,15 Z"
                                                fill="#000000" />
                                            <path d="M9,9 L7,9 L7,5 L9,5 L9,9 Z M9,15 L9,20 L7,20 L7,15 L9,15 Z"
                                                fill="#000000" opacity="0.3" />
                                            <rect fill="#000000" opacity="0.3" x="0" y="11"
                                                width="24" height="2" rx="1" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">Qr Codes</span>
                        </a>
                    </li> --}}
                    <!--end::Item-->
                </ul>
                <!--end::Nav Tabs-->
            </div>
            <!--end::Body-->
        </div>
        <!--begin::Nav Panel Widget 1-->
    </div>
</div>
