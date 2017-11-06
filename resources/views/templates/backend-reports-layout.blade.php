<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Welcome') | {{ config('app.name', 'Hotel Cabañas de Wanda') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
    @yield('styles')
</head>
<body>
<div class="container-fluid container-backend">
    <div id="header" class="row">
        @section('header')
            @include('templates.headers.main-header')
        @show
    </div>
    <div id="content" class="row">
        <div id="main_content" class="col-md-offset-1 col-md-4">
            <div class="panel">
                @include('messages_alerts.flash-and-errors')
                @yield('content')
            </div>
        </div>
        @yield('optional')
    </div>
    <div id="footer" class="row">
        @section('footers')
        @show
        <div id="footer_rights" class="col-md-12 text-center">
            <i class="fa fa-registered" aria-hidden="true"></i> Hotel Cabañas de Wanda. Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2010 - {{ (isset($year)) ? $year : 2017 }}. All right reserved.
            <br>
            Developed by Diego A. Zapata Häntsch
        </div>
    </div>
</div>
<script src="{{ asset('js/libraries.js') }}"></script>
<script src="{{ asset('js/backend.js') }}"></script>
@yield('scripts')
</body>
</html>