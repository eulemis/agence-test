@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('dashboard')</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/agence') }}">
                    <i class="fa fa-diamond"></i>
                    <span>@lang('Agence')</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/projecto') }}">
                    <i class="fa fa-cube"></i>
                    <span>@lang('Projetos')</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/administrativo') }}">
                    <i class="fa fa-folder-o"></i>
                    <span>@lang('Administrativo')</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/comercial') }}">
                    <i class="fa fa-shopping-bag"></i>
                    <span>@lang('Comercial')</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/financeiro') }}">
                    <i class="fa fa-money"></i>
                    <span>@lang('Financeiro')</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/usuario') }}">
                    <i class="fa fa-group"></i>
                    <span>@lang('Usuário')</span>
                </a>
            </li>
            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-close"></i>
                    <span class="title">@lang('Salir')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

