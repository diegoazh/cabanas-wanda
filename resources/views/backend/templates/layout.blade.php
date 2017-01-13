<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'Welcome') | Caba&ntilde;as de Wanda</title>
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
</head>
<body>
  <div class="container-fluid">
    <div id="header" class="row">
      @section('header')
      @show
    </div>
    <div id="body" class="row">
      @section('body')
      @show
    </div>
    <div id="footer" class="row">
      @section('footer')
      @show
    </div>
  </div>
  <script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>