<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cabañas de Wanda') }}</title>
    <!-- Styles -->
    <link rel="icon" href="{{ asset('images/logos/logo-cabanas-wanda-45x44.ico') }}">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/dashicons/css/dashicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/frontend.css') }}">
    @section('estilos')
    @show
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
            <div class="col-md-8 col-md-offset-3"></div>
        @show
    </div>
    @include('templates.contents.content')
    <div id="footer" class="row">
        @section('footer')
        @show
        <div id="footer_rights" class="col-md-12 text-center">
            <i class="fa fa-registered" aria-hidden="true"></i> Cabañas de Wanda. Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2010 - {{ (isset($year)) ? $year : 2017 }}. All right reserved.
            <br>
            Developed by Diego A. Zapata Häntsch
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="/js/frontend.js"></script>
</body>
</html>
