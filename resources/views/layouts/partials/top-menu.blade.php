<ul class="nav navbar-nav pull-right">

    <li class="dropdown dropdown-user">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <img alt="" class="img-circle" src="{{ asset('assets/img/avatar.png') }}" />
            <span class="username username-hide-on-mobile">
             Agence | Services
            </span>
            <i class="fa fa-angle-down"></i>
            </br>
        </a>

        <ul class="dropdown-menu dropdown-menu-default">
            <li>
                <a href="#">
                    <i class="icon-user"></i>Perfil </a>
            </li>
            
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="icon-power"></i>Salir

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
            </li>
        </ul>
    </li>
    <!-- END USER LOGIN DROPDOWN -->

</ul>