<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('users/css/main.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--begin::Global Theme Styles(used by all pages)-->
    {{-- <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Warung Aceh Bang Ari</title>
</head>

<body>

    {{-- Header Navbara --}}
    <div class="headers" id="header">
        <nav class="navbars container d-flex justify-content-center"">
            <div class="brand">
                <img src="{{ asset('media/client-logos/logo.png') }}" class="logo-brand" />
                Warung Aceh Bang Ari
            </div>
        </nav>
        <div class="container fillter-section">
            <div class="row">
                <div class="col-sm-8">
                    <select class="form-select form-select-sm fillter-category" aria-label="Default select example">
                        <option selected>Bundle</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    {{-- search --}}
                </div>
            </div>
        </div>
    </div>
    {{-- End Header Navbar --}}
    {{-- <div class="product-wrap container"> --}}
    {{-- </div> --}}
    <div class="main">
        @yield('content')
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('users/js/main.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script> --}}
    {{-- <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script> --}}
    @yield('js')
</body>

</html>
