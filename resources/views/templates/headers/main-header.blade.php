    <nav class="navbar navbar-default navbar-static-top general-menu">
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
                        <a href="{{ route('home.cottages.index') }}">
                            <i class="fa fa-home" aria-hidden="true"></i> Caba&ntilde;as
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('home.rentals.index') }}">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i> Reservas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route(Auth::check() ? (Auth::user()->isAdminOrEmployed() ? 'comidas.index' : 'home') : 'home') }}">
                            <i class="fa fa-cutlery" aria-hidden="true"></i> Comidas
                        </a>
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
                                <img class="img-responsive img-circle" src="@if(!empty(Auth::user()->imageProfile)) {{ asset('images/profiles/' . Auth::user()->imageProfile) }} @elseif(Auth::user()->genre === 'm') {{ asset('images/profiles/chico-jopo.png') }} @else {{ asset('images/profiles/chica-rodete.png') }} @endif" alt="{{ Auth::user()->displayName() }}" alt="{{ Auth::user()->imageProfile }}"> {{ Auth::user()->name }} <span class="caret"></span>
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