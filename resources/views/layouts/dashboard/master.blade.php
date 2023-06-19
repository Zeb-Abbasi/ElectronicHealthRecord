<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        @include('partials.dashboard.sidebar')
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            @include('partials.dashboard.header')

            <main>
                @yield('content')
            </main>

            <!-- Footer-->
            @include('partials.dashboard.footer')
        </div>
    </div>


   <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('js/dashboard.js') }}"></script>


</body>

</html>
