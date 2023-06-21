<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/staterestore/1.2.2/css/stateRestore.bootstrap5.min.css" rel="stylesheet">
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

        </div>
    </div>


   <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/staterestore/1.2.2/js/dataTables.stateRestore.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/staterestore/1.2.2/js/stateRestore.bootstrap5.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
   <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('js/dashboard.js') }}"></script>


</body>

</html>
