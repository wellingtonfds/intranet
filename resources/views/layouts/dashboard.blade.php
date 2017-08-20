<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    {{--<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">--}}
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('/css/custom.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    {{--Jquery UI--}}
    <link href="{{ asset('/css/jquery-ui.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
    <style>
        .navbar .nav_title{
            background: red;
        }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/home" class="site_title">
                        <img src="{{asset('img/Logo_LyonFacilities.png')}}" width="100" height="70" style="margin-left: -5px">
                    </a>
                </div>
                <div class="clearfix"></div>
                <br />
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li><a href="/home">
                                    <i class="fa fa-home"></i> Home
                                </a>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Informes <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                </ul>
                            </li>
                            @can('admin')
                            <li>
                                <a href="/users"><i class="fa fa-user">
                                    </i>Usuários<span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li>
                                <a href="/categories"><i class="fa fa-list">
                                    </i>Categorias<span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li>
                                <a href="/procedures"><i class="fa fa-file">
                                    </i>Prodecimentos<span class="fa fa-chevron-down"></span></a>

                            </li>
                            <li>
                                <a href="/suggestions"><i class="fa fa-question">
                                    </i>Sugestões<span class="fa fa-chevron-down"></span></a>

                            </li>
                            @endcan

                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    {{--<a data-toggle="tooltip" data-placement="top" title="Settings">--}}
                        {{--<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    {{--<a data-toggle="tooltip" data-placement="top" title="FullScreen">--}}
                        {{--<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    {{--<a data-toggle="tooltip" data-placement="top" title="Lock">--}}
                        {{--<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>

                    </div>
                    <ul class="nav navbar-nav">
                        <li>
                            <p class="navbar-text" style="font-size:15px;font-weight:bold">Informe Gestão de Notas Fiscais</p>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                {{--<li><a href="javascript:;"> Profile</a></li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="badge bg-red pull-right">50%</span>--}}
                                        {{--<span>Settings</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li><a href="javascript:;">Help</a></li>--}}
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                        <i class="fa fa-sign-out pull-right"></i> Sair</a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>


                            </ul>
                        </li>


                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
            <!-- top tiles -->
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-left">
                <img src="{{asset('img/footer_left.jpg')}}" height="50px">
                {{--<span>{{ config('app.name', '12910 - Informe Gestão de Notas Ficais') }}</span>--}}
            </div>
            <div class="pull-right">
                <img src="{{asset('img/footer_right.jpg')}}" height="50px">
                {{--<span>{{ config('app.name', '12910 - Informe Gestão de Notas Ficais') }}</span>--}}
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/all.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>

<!-- jQuery -->
{{--<script src="../vendors/jquery/dist/jquery.min.js"></script>--}}
<!-- Bootstrap -->
{{--<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>--}}
<!-- FastClick -->
<script src="{{ asset('/vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
{{--<script src="../vendors/nprogress/nprogress.js"></script>--}}
<!-- Chart.js -->
<script src="{{ asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
<!-- gauge.js -->
<script src="{{ asset('vendors/gauge.js/dist/gauge.min.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
<!-- Skycons -->
<script src="{{ asset('vendors/skycons/skycons.js') }}"></script>
<!-- Flot -->
<script src="{{ asset('vendors/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('vendors/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('vendors/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('vendors/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('vendors/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
<script src="{{ asset('vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('vendors/flot.curvedlines/curvedLines.js') }}"></script>
<!-- DateJS -->
<script src="{{ asset('vendors/DateJS/build/date.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
<script src="{{ asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('/js/custom.js') }}"></script>
<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/jquery.media.js') }}"></script>
@yield('scripts')

</body>
</html>
