<ul class="menu">
    <li class="item"><a href="#" class="panel-dash">Panel</a>
        <ul>
            <li class="subitem"><a href="{{ route('admin.panel') }}">Administraci&oacute;n</a></li>
        </ul>
    </li>
    <li class="item"><a href="#" class="frontend">P&aacute;gina principal</a>
        <ul>
            <li class="subitem"><a href="{{ route('frontend.create') }}">Configuraci&oacute;n</a></li>
        </ul>
    </li>
    <li class="item"><a href="#" class="cottage">Caba&ntilde;as <span>{{ (isset($cantCottages)) ? $cantCottages : 0 }}</span></a>
        <ul>
            <li class="s>
  em"><a href="{{ route('cottages.index') }}">Listado de caba&ntilde;as<span>{{ (isset($cantCottages)) ? $cantCottages : 0 }}</span></a></li>
            @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                <li class="subitem"><a href="{{ route('cottages.create') }}">Registrar caba&ntilde;a</a></li>
            @endif
        </ul>
    </li>
    <li class="item"><a href="#" class="promotion">Promociones <span>{{ isset($cantPromotions) ? $cantPromotions : 0 }}</span></a>
        <ul>
            <li class="subitem"><a href="{{ route('promotions.create') }}">Promociones <span>{{ isset($cantPromotions) ? $cantPromotions : 0 }}</span></a></li>
        </ul>
    </li>
    <li class="item"><a href="#" class="claims">Reclamos <span>{{ isset($cantClaims) ? $cantClaims : 0 }}</span></a>
        <ul>
            <li class="subitem"><a href="#">Listado de reclamos <span>{{ isset($cantClaims) ? $cantClaims : 0 }}</span></a></li>
            <li class="subitem"><a href="#">Crear reclamo</a></li>
        </ul>
    </li>
    <li class="item"><a href="#" class="users">Usuarios <span>{{ (isset($cantUsers)) ? $cantUsers : 0 }}</span></a>
        <ul>
            <li class="subitem"><a href="{{ route('users.index') }}">Lista de usuarios <span>{{ (isset($cantUsers)) ? $cantUsers : 0 }}</span></a></li>
        </ul>
    </li>
</ul>
