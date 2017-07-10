<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>SGBR</title>
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADAAAAAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABLAAAA2QAAANkAAABLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACUAAACzAAAA/wAAAP8AAAD/AAAA/wAAALMAAAAlAAAAAAAAAHkAAAA2AAAAAAAAAAAAAAAAAAAAAAAAAHsAAAD3AAAA/wAAAPMAAAD/AAAA/wAAAPUAAAD/AAAA9wAAAHsAAACYAAAAOwAAAAAAAAAAAAAAAAAAAAMAAADyAAAAxwAAAMQAAAD1AAAA/wAAAP8AAAD1AAAAxgAAAMgAAADyAAAAmwAAADsAAAAAAAAAAAAAAAAAAAABAAAAeAAAANkAAAD/AAAA/wAAAP8AAAD/AAAA/wAAAP8AAADZAAAAeQAAAHEAAAA2AAAAAAAAAAAAAAAkAAAAsgAAAP8AAAD/AAAA/wAAAP8AAAD/AAAA/wAAAP8AAAD/AAAA/wAAAP8AAACyAAAAJAAAAAAAAAARAAAA2QAAAP8AAAD/AAAA/wAAAP8AAAD/AAAA/wAAAP8AAAD/AAAA/wAAAP8AAAD/AAAA/wAAANkAAAARAAAAAAAAAAcAAABpAAAA4QAAAP8AAAD/AAAA/wAAAP8AAAD/AAAA/wAAAP8AAAD/AAAA4QAAAGkAAAAHAAAAAAAAAAAAAAAAAAAAAAAAAAgAAABqAAAA4gAAAP8AAAD/AAAA/wAAAP8AAADiAAAAagAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAcAAABrAAAA4QAAAOEAAABrAAAABwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//8AAP//AAD+fwAA+BkAAPAJAADAAQAAwAEAAMABAACAAQAAAAAAAIABAADgBwAA+B8AAP5/AAD//wAA//8AAA==" rel="icon" type="image/x-icon">
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
                    <a href="{{ route('home.index') }}" class="site_title">
                        &nbsp;<img alt="logotipo" src="{{asset('assets/img/cap.png')}}"/> &nbsp;<span>SGBR</span>
                    </a>
                </div>
                <div class="clearfix"></div>
                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            @if(Auth::check())
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
                                <li><a><i class="fa fa-wrench"></i> Gerenciar <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('emprestimo.index') }}">Empréstimos</a></li>
                                        <li><a href="{{ route('reserva.index') }}">Reservas</a></li>
                                        <li><a href="{{ route('reserva-recurso.index') }}">Reservas de Recursos</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-file-pdf-o"></i> Relatórios <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('aluno.pendente') }}">Alunos Pendentes</a></li>
                                        <li><a href="{{ route('funcionario.pendente') }}">Funcionários Pendentes</a></li>
                                        <li><a href="{{ route('publicacao.emprestada') }}">Publicações mais Emprestadas</a></li>
                                        <li><a href="{{ route('aluno.emprestimo') }}">Alunos com mais Empréstimos</a></li>
                                        <li><a href="{{ route('funcionario.emprestimo') }}">Funcionários com mais Empréstimos</a></li>
                                    </ul>
                                </li>
                                @if(Auth::user()->tipo_acesso != 2)
                                    <li><a><i class="fa fa-user"></i> Usuários <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ route('aluno.index') }}">Alunos</a></li>
                                            <li><a href="{{ route('funcionario.index') }}">Funcionários</a></li>
                                            <li><a href="{{ route('turma.index') }}">Turmas</a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->tipo_acesso == 0)
                                    <li><a><i class="fa fa-low-vision"></i> Transações <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ route('log.index') }}"><i class="fa fa-dashboard"></i> Sumarização</a></li>
                                            <li><a href="{{ route('log.list') }}"><i class="fa fa-eye"></i> Logs</a></li>
                                        </ul>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
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

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="badge bg-danger"></span>
                                </a>
                                <ul id="menu-notificacao" class="dropdown-menu list-unstyled msg_list" role="menu">
                                </ul>
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
<script src="{{asset('assets/js/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/js/moment/pt-br.js')}}"></script>

@include('layout.includes.validate-request')

@yield('scripts')

<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{route("emprestimo.atrasado")}}',
            dataType: 'json',
            type: 'get',
            success: function(data) {
                $(data).each(function() {
                    var dataPrevista = moment.duration(moment().diff(moment($(this).attr('data_prevista'), 'YYYY-MM-DD HH:mm:ss'))).humanize();

                    $('#menu-notificacao').append(
                            '<li><a><span><span><strong>' + $(this).attr('nome') + '</strong></span>' +
                            '<span class="time">' + $(this).attr('data_emprestimo') + '</span></span>' +
                            '<span class="message">Empréstimo Atrasado: '+ dataPrevista +'</span></a></li>'
                    );
                });
                $('.badge.bg-danger').html(data.length);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                console.log(xmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    })
</script>

<script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>