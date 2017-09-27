<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Hotel Cabañas de Wanda') }}</title>
    <!-- Styles -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    @yield('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app" class="container-fluid">
    <div id="header" class="row">
        @include('templates.headers.main-header')
        @section('header')
            <div id="overlay"></div>
            <div class="col-md-8 col-md-offset-3 container-logo"></div>
        @show
        <div id="arrow_left" class="col-md-6"></div>
        <div id="arrow_right" class="col-md-6"></div>
    </div>
    @include('templates.contents.frontend-content')
    <div id="footer" class="row">
        @section('footer')
        @show
        <div id="footer_rights" class="col-md-12 text-center">
            <i class="fa fa-registered" aria-hidden="true"></i> Hotel Cabañas de Wanda. Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2010 - {{ (isset($year)) ? $year : 2017 }}. All right reserved.
            <br>
            Developed by Diego A. Zapata Häntsch
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/libraries.js') }}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>
@yield('scripts')
</body>
</html>
