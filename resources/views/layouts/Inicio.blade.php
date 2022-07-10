<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel')</title>

    <link rel="stylesheet" href="{{ asset('css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('css')
</head>

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 2-columns" data-open="click"
    data-menu="vertical-dark-menu" data-col="2-columns">


    @include('layouts.header.header')

    @include('layouts.Menu_Vertical.Menu_Vertical')

    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="col s12">
                <div class="container">
                    <div class="section">

                        @yield('content')
                        @include('layouts.Modal.ModalEditarProd')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer
        class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>© 2020 <a
                        href="http://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
                        target="_blank">PIXINVENT</a> All rights reserved.</span><span
                    class="right hide-on-small-only">Design and Developed by <a
                        href="https://pixinvent.com/">PIXINVENT</a></span></div>
        </div>
    </footer>


    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('js/plugins.min.js') }}"></script>
    <script src="{{ asset('js/custom-script.min.js') }}"></script>
    <script src="{{ asset('js/customizer.min.js') }}"></script>
    <script src="{{ asset('js/dashboard-modern.js') }}"></script>


    @yield('scripts')
    <script>
           
        $(document).ready(function() {
            
            $('#cant_efectivo, .precio_prod').mask('00.000', {
                min: 1,
                max: 20000,
                reverse: true
            });
       
            number_format = function(number, decimals, dec_point, thousands_sep) {
                number = number.toFixed(decimals);

                var nstr = number.toString();
                nstr += '';
                x = nstr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? dec_point + x[1] : '';
                var rgx = /(\d+)(\d{3})/;

                while (rgx.test(x1))
                    x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

                return '$' + x1 + x2;
            }

            $('.modal').modal();
            $('tabs').tabs();
             $('.tooltipped').tooltip();
             $('select').material_select();

            
        });
    </script>

</body>

</html>
