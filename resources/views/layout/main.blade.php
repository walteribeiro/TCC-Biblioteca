<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>SGBR</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    @yield('header')
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ url('/') }}" class="site_title"><i class="fa fa-graduation-cap"></i> <span>SGBR</span></a>
                </div>

                <div class="clearfix"></div>
                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-book"></i> Publicações <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('livro.index')}}">Livros</a></li>
                                    <li><a href="{{route('revista.index')}}">Revistas</a></li>
                                    <li><a href="{{route('editora.index')}}">Editoras</a></li>
                                    <li><a href="{{route('autor.index')}}">Autores</a></li>
                                </ul>
                            </li>

                            <!-- li><a><i class="fa fa-users"></i> Leitores <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="#">Alunos</a></li>
                                    <li><a href="#">Funcionários</a></li>
                                    <li><a href="index3.html">Professores</a></li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-wrench"></i> Gerenciar <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="#">Emprestimos</a></li>
                                    <li><a href="#">Reservas</a></li>
                                    <li><a href="#">Reservas de Recursos</a></li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-map"></i> Recursos <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="#">Mapas</a></li>
                                    <li><a href="#">Salas</a></li>
                                    <li><a href="#">Data Shows</a></li>
                                </ul>
                            </li -->
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
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                Bibliotecário
                                <span class=" fa fa-angle-down"></span>
                            </a>
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
    </div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script src="{{asset('assets/js/gauge.min.js')}}"></script>
<script src="{{asset('assets/js/icheck.min.js')}}"></script>
<script src="{{asset('assets/js/skycons.js')}}"></script>
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/daterangepicker.js')}}"></script>
<script src="{{asset('assets/js/toastr.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

@yield('scripts')

</body>

</html>