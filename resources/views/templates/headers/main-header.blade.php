    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <span id="app_name">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <!-- Collapsed Hamburger -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.cottages.index') }}">
                        <i class="fas fa-home" aria-hidden="true"></i> Caba&ntilde;as
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-handshake" aria-hidden="true"></i> Reservas <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('home.rentals.index') }}">Realizar reserva</a>
                        <a class="dropdown-item" href="{{ route('home.rentals.edit') }}">Modificar o cancelar</a>
                        <a class="dropdown-item" href="{{ route('home.liquidation.liquidation') }}">Ver liquidación</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-utensils" aria-hidden="true"></i> Comidas <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('home.order.index') }}">Realizar pedido</a>
                        <a class="dropdown-item" href="#">Modificar pedido</a>
                        @if(Auth::check())
                            @if(Auth::user()->isAdminOrEmployed())
                                <div role="separator" class="dropdown-divider"></div>
                                @if(Auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('comidas.index') }}">Administración de platos</a>
                                @endif
                            @endif
                        @endif
                    </div>
                </li>
                @if(Auth::check())
                    @if(Auth::user()->isAdminOrEmployed())
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}"><i class="fas fa-chart-line" aria-hidden="true"></i> Reportes</a></li>
                        @endif
                    @endif
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav mr-0">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Ingresar <i class="fas fa-sign-in-alt" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Registrarse <i class="fas fa-address-book" aria-hidden="true"></i></a></li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle img-user-profile" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img class="img-fluid rounded-circle" src="@if(!empty(Auth::user()->imageProfile)) {{ asset('images/profiles/' . Auth::user()->imageProfile) }} @elseif(Auth::user()->genre === 'm') {{ asset('images/profiles/chico-jopo.png') }} @else {{ asset('images/profiles/chica-rodete.png') }} @endif" alt="{{ Auth::user()->formalFullname }}" alt="{{ Auth::user()->imageProfile }}" width="8%" style="display: inline-block"> {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu" role="menu">
                            @if(Auth::user()->isAdmin())
                                <a class="dropdown-item" href="{{ route('admin.panel') }}">
                                    <i class="fas fa-tachometer-alt" aria-hidden="true"></i> Administración
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('home.profile.rentals', Auth::user()->slug) }}">
                                <i class="far fa-handshake" aria-hidden="true"></i> Mis reservas
                            </a>
                            <a class="dropdown-item" href="{{ route('home.profile.show', Auth::user()->slug) }}">
                                <i class="fas fa-user-circle" aria-hidden="true"></i> Perfil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>