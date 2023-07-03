<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>

<body style="background-color: #17a2b8;">

    <div class="container py-5 ">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-3 p-sm-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')

</body>

</html>
