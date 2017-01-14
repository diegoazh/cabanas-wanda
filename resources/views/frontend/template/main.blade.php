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
    <link href="/css/app.css" rel="stylesheet">
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
        @section('header')
        @show
      </div>
      <div id="content" class="row">
        @section('content')
        @show
      </div>
      <div id="footer" class="row">
        @section('footer')
        @show
      </div>
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
  </body>
</html>
