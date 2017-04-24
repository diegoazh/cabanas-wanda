<h2 class="tt-menu"><i class="fa fa-tachometer" aria-hidden="true"></i> Administraci&oacute;n</h2>
<div id="wrapper">
    <ul class="menu">
        <li class="item"><a href="#" class="home">P&aacute;gina principal</a>
            <ul>
                <li class="subitem"><a href="{{ route('admin.homePage') }}">Configuraci&oacute;n</a></li>
            </ul>
        </li>
        <li class="item"><a href="#" class="cottage">Caba&ntilde;as <span>{{ (isset($cantCottages)) ? $cantCottages : 0 }}</span></a>
            <ul>
                <li class="subitem"><a href="{{ route('cottages.index') }}">Listado de caba&ntilde;as<span>{{ (isset($cantCottages)) ? $cantCottages : 0 }}</span></a></li>
                @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                    <li class="subitem"><a href="{{ route('cottages.create') }}">Registrar caba&ntilde;a</a></li>
                @endif
            </ul>
        </li>
        <li class="item"><a href="#">Promociones <span>147</span></a>
            <ul>
                <li class="subitem"><a href="#">Listado de promos <span>14</span></a></li>
                <li class="subitem"><a href="#">Crear promo <span>6</span></a></li>
            </ul>
        </li>
        <li class="item"><a href="#">Reclamos <span>340</span></a>
            <ul>
                <li class="subitem"><a href="#">Listado de reclamos <span>14</span></a></li>
                <li class="subitem"><a href="#">Crear reclamo <span>6</span></a></li>
            </ul>
        </li>
        <li class="item"><a href="#">Pasajeros <span>222</span></a>
            <ul>
                <li class="subitem"><a href="#">Listado de pasajeros <span>14</span></a></li>
            </ul>
        </li>
        <li class="item"><a href="#" class="users">Usuarios <span>{{ (isset($cantUsers)) ? $cantUsers : 0 }}</span></a>
            <ul>
                <li class="subitem"><a href="{{ route('users.index') }}">Lista de usuarios <span>{{ (isset($cantUsers)) ? $cantUsers : 0 }}</span></a></li>
            </ul>
        </li>
    </ul>
</div>