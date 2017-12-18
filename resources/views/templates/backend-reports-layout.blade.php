<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Welcome') | {{ config('app.name', 'Hotel Cabañas de Wanda') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
    <link rel='stylesheet' href='{{ asset('lib/glyphicons-only-bootstrap/css/bootstrap.min.css') }}'>
    @yield('styles')
</head>
<body class="bg-light">
    <div class="container-fluid container-backend">
        <div id="header" class="row">
            @include('templates.headers.main-header')
            <div style="height: 5rem"></div>
        </div>
        <div id="content" class="row">
            <div id="main_content" class="col-12 col-md-4">
                <div id="content_backend" class="card">
                    @include('messages_alerts.messages-and-errors')
                    @yield('content')
                </div>
            </div>
        </div>
        <div id="footer" class="row">
            @section('footers') @show
            <div id="footer_rights" class="col-12 text-center">
                <i class="fa fa-registered" aria-hidden="true"></i> Hotel Cabañas de Wanda. Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2010 - {{ (isset($year)) ? $year : 2017 }}. All right reserved.
                <br>
                Developed by Diego A. Zapata Häntsch
            </div>
        </div>
    </div>
    <script src="{{ asset('js/libraries.js') }}"></script>
    <script src="{{ asset('js/backend.js') }}"></script>
    <script type="application/javascript">
        $(document).ready(function () {
            $('.navbar-light').removeClass('navbar-light bg-light').addClass('navbar-dark bg-dark');
        });
    </script>
    @yield('scripts')
</body>
</html>