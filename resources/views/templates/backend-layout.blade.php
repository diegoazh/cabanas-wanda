<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Welcome') | Caba&ntilde;as de Wanda</title>
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/dashicons/css/dashicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/backend.css') }}">
    @section('estilos')
    @endsection
</head>
<body>
<div class="container-fluid">
    <div id="header" class="row">
        @section('header')
            @include('templates.headers.main-header')
        @show
    </div>
    <div id="content" class="row">
        <div id="main_menu" class="col-md-2">
            @include('backend.menus.main-menu-backend')
        </div>
        <div id="main_content" class="col-md-offset-1 col-md-4">
            <div class="panel">
                @include('messages_alerts.flashAndErrors')
                @yield('content')
            </div>
        </div>
        @yield('optional')
    </div>
    <div id="footer" class="row">
        @section('footers')
        @show
    </div>
</div>
<script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main-menu-backend.js') }}"></script>
<script src="{{ asset('js/backend.js') }}"></script>
</body>
</html>