<h2 class="tt-menu"><i class="fa fa-tachometer" aria-hidden="true"></i> Administraci&oacute;n</h2>
<div id="wrapper">
    <ul class="menu">
        <li class="item"><a href="#" class="cottage">Caba&ntilde;as <span>10</span></a>
            <ul>
                <li class="subitem"><a href="#">Listado de caba&ntilde;as<span>6</span></a></li>
                <li class="subitem"><a href="{{ route('cottages.create') }}">Registrar caba&ntilde;a</a></li>
                <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
            </ul>
        </li>
        <li class="item"><a href="#">Promociones <span>147</span></a>
            <ul>
                <li class="subitem"><a href="#">Cute Kittens <span>14</span></a></li>
                <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
            </ul>
        </li>
        <li class="item"><a href="#">Reclamos <span>340</span></a>
            <ul>
                <li class="subitem"><a href="#">Cute Kittens <span>14</span></a></li>
                <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
            </ul>
        </li>
        <li class="item"><a href="#">Pasajeros <span>222</span></a>
            <ul>
                <li class="subitem"><a href="#">Cute Kittens <span>14</span></a></li>
                <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
            </ul>
        </li>
        <li class="item"><a href="#" class="users">Usuarios <span>{{ (isset($cantUsers)) ? $cantUsers : 0 }}</span></a>
            <ul>
                <li class="subitem"><a href="{{ route('users.index') }}">Lista de usuarios <span>{{ (isset($cantUsers)) ? $cantUsers : 0 }}</span></a></li>
                <li class="subitem"><a href="#">Strange “Stuff” <span>6</span></a></li>
                <li class="subitem"><a href="#">Automatic Fails <span>2</span></a></li>
            </ul>
        </li>
    </ul>
</div>