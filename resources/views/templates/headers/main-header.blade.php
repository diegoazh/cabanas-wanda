    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span id="app_name">{{ config('app.name', 'Laravel') }}</span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="{{ route('home.cottages.index') }}"><i class="fa fa-home" aria-hidden="true"></i> Caba&ntilde;as</a>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Ingresar <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                        <li><a href="{{ url('/register') }}">Registrarse <i class="fa fa-address-card-o" aria-hidden="true"></i></a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle img-user-profile" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img class="img-responsive img-circle" src="{{ '/images/profiles/' . Auth::user()->imageProfile }}" alt="{{ Auth::user()->imageProfile }}"> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                                    <li>
                                        <a href="{{ route('admin.panel') }}">
                                            <i class="fa fa-tachometer" aria-hidden="true"></i> Administración
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('home.profile.show', Auth::user()->slug) }}">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Perfil
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar sesión <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>