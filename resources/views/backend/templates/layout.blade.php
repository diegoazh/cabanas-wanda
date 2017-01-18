<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'Welcome') | Caba&ntilde;as de Wanda</title>
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/backend/backend.css') }}">
</head>
<body>
  <div class="container-fluid">
    <div id="header" class="row">
      @section('header')
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ route('home') }}">Caba&ntilde;as de Wanda</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Panel<span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-left">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      @show
    </div>
    <div id="content" class="row">
      <div id="main_menu" class="col-md-2">
        <h2 class="tt-menu"><i class="fa fa-tachometer" aria-hidden="true"></i> Administraci&oacute;n</h2>
        <div id="wrapper">
          <ul class="menu">
              <li class="item"><a href="#">Caba&ntilde;as <span>10</span></a>
                <ul>
                  <li class="subitem"><a href="{{ route('cottages.create') }}">Registrar caba&ntilde;a <span>14</span></a></li>
                  <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                  <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
                </ul>
              </li>
              <li class="item"><a href="#">Videos <span>147</span></a>
                <ul>
                  <li class="subitem"><a href="#">Cute Kittens <span>14</span></a></li>
                  <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                  <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
                </ul>
              </li>
              <li class="item"><a href="#">Galleries <span>340</span></a>
                <ul>
                  <li class="subitem"><a href="#">Cute Kittens <span>14</span></a></li>
                  <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                  <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
                </ul>
              </li>
              <li class="item"><a href="#">Podcasts <span>222</span></a>
                <ul>
                  <li class="subitem"><a href="#">Cute Kittens <span>14</span></a></li>
                  <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                  <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
                </ul>
              </li>
              <li class="item"><a href="#">Robots <span>16</span></a>
                <ul>
                  <li class="subitem"><a href="#">Cute Kittens <span>14</span></a></li>
                  <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                  <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
                </ul>
              </li>
          </ul>
        </div>
      </div>
      <div id="main_content" class="col-md-offset-1 col-md-4">
        @yield('content')
      </div>
    </div>
    <div id="footer" class="row">
      @section('footer')
        <div class="col-md-12">
        </div>
      @show
    </div>
  </div>
  <script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/main-menu-backend.js') }}"></script>
</body>
</html>