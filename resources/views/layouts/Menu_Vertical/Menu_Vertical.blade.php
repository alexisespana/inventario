<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square nav-collapsed">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="/"><img class="hide-on-med-and-down"
                    src="{{ asset('img/materialize-logo-color.png') }}" alt="materialize logo"><img
                    class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('img/materialize-logo.png') }}"
                    alt="materialize logo"><span class="logo-text hide-on-med-and-down">Materialize</span></a><a
                class="navbar-toggler" href="#"><i class="material-icons">radio_button_unchecked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow ps ps--active-y"
        id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion"
        style="transform: translateX(0px);">
        <li class=" bold "><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"
                tabindex="0"><i class="material-icons">settings_input_svideo</i><span class="menu-title"
                    data-i18n="Dashboard">Dashboard</span><span
                    class="badge badge pill orange float-right mr-10">3</span></a>
            <div class="collapsible-body" style="display: block;">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="active"><a class="active" href="/"><i
                                class="material-icons">radio_button_unchecked</i><span
                                data-i18n="Modern">Incio</span></a>
                    </li>
                    <li><a href="/ventas/listar"><i class="material-icons">radio_button_unchecked</i><span
                                data-i18n="eCommerce">Ventas</span></a>
                    </li>
                    <li><a href="/productos/lista"><i class="material-icons">radio_button_unchecked</i><span
                                data-i18n="Analytics">Lista de Productos</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="navigation-header"><a class="navigation-header-text">Applications</a><i
                class="navigation-header-icon material-icons">more_horiz</i>
        </li>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="/productos/Ingresar"><i
                class="material-icons">mail_outline</i><span class="menu-title"
                data-i18n="Mail">Ingresar Productos</span><span
                class="badge new badge pill pink accent-2 float-right mr-2">5</span></a>
    </li>
    </ul>
    <div class="navigation-background"></div><a
        class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
