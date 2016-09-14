<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>SGBR</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/nprogress.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">

    @yield('header')
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ route('home.index') }}" class="site_title"><i class="fa fa-graduation-cap"></i> <span>SGBR</span></a>
                </div>
                <div class="clearfix"></div>
                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li>
                                <a href="{{route('home.index')}}"><i class="fa fa-home"></i> Inicial</a>
                            </li>
                            <li><a><i class="fa fa-book"></i> Publicações <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('autor.index')}}">Autores</a></li>
                                    <li><a href="{{route('editora.index')}}">Editoras</a></li>
                                    <li><a href="{{route('livro.index')}}">Livros</a></li>
                                    <li><a href="{{route('revista.index')}}">Revistas</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-map"></i> Recursos <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('data-show.index') }}">Data Shows</a></li>
                                    <li><a href="{{ route('mapa.index') }}">Mapas</a></li>
                                    <li><a href="{{ route('sala.index') }}">Salas</a></li>
                                </ul>
                            </li>
                            @if(Auth::user()->tipo_acesso == 0)
                                <li><a><i class="fa fa-user"></i> Usuários <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('funcionarios') }}">Funcionários</a></li>
                                    </ul>
                            </li>

                            <li><a><i class="fa fa-low-vision"></i> Transações <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('log-viewer::dashboard') }}"><i class="fa fa-dashboard"></i> Sumarização</a></li>
                                    <li><a href="{{ route('log-viewer::logs.list') }}"><i class="fa fa-eye"></i> Logs</a></li>
                                </ul>
                            </li>
                            @endif

                            <li><a><i class="fa fa-wrench"></i> Gerenciar <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    {{--<li><a href="#">Emprestimos</a></li>--}}
                                    {{--<li><a href="#">Reservas</a></li>--}}
                                    <li><a href="{{ route('reserva-recurso.index') }}">Reservas de Recursos</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                 /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->nome }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Sair do sistema</a></li>
                                    <li>
                                        <a data-toggle="modal" data-target="#change-user-modal" ><i class="fa fa-btn fa-refresh"></i> Mudar de usuário</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                                    <!-- ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;"> Perfil</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">Help</a></li>
                                <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul -->
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="container">
                @yield('conteudo')
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                SGBR - Sistema Gerenciador de Biblioteca e Recursos
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

        @include('layout.modal-change-user')
    </div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script src="{{asset('assets/js/nprogress.js')}}"></script>
<script src="{{asset('assets/js/toastr.js')}}"></script>

@include('layout.includes.validate-request')

@yield('scripts')

<script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>