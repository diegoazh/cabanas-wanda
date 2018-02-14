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
    <link rel='stylesheet' href='{{ asset('lib/glyphicons-only-bootstrap/css/bootstrap.min.css') }}'>
    <link rel="stylesheet" href="{{ asset('font-awesome/css/fontawesome-all.css') }}">
    @yield('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app" class="container-fluid container-frontend">
    <div id="header" class="row">
        @include('templates.headers.main-header')
        @section('header')
            <div class="col-12 mx-0 px-0">
                <div id="overlay"></div>
                <div id="container_logo" class="col-12 col-md-9 ml-auto">
                    <img class="img-fluid" src="{{ asset('images/logos/logo-cabanas-wanda-290x283.png') }}" alt="">
                </div>
            </div>
        @show
    </div>
    <div id="arrows_div" class="row">
        <div id="arrow_left" class="col-6"></div>
        <div id="arrow_right" class="col-6"></div>
    </div>
    @include('templates.contents.frontend-content')
    <div id="footer" class="row">
        @section('footer')
        @show
        @include('templates.footers.main-footer')
        <div id="footer_rights" class="col-12 px-2 text-center">
            <i class="far fa-registered" aria-hidden="true"></i> Hotel Cabañas de Wanda. Copyright <i class="far fa-copyright" aria-hidden="true"></i> 2010 - {{ (isset($year)) ? $year : 2017 }}. All right reserved.
            <br>
            Developed by Diego A. Zapata Häntsch
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/libraries.js') }}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>
<script>
    $('#flash-overlay-modal').modal();
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@yield('scripts')
</body>
</html>
