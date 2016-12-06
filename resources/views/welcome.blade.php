@extends('layout.main')

@section('conteudo')

    <br><br>
    <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Total de Livros</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content text-center">
                    <canvas id="canvas-livros" width="150" height="80" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                        <span id="livros" class="gauge-value gauge-text text-center"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Total de Empréstimos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content text-center">
                    <canvas id="canvas-emprestimos" width="150" height="80" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                        <span id="emprestimos" class="gauge-value gauge-text text-center"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Total de Revistas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content text-center">
                    <canvas id="canvas-revistas" width="150" height="80" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                        <span id="revistas" class="gauge-value gauge-text text-center"></span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Total de Alunos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content text-center">
                    <canvas id="canvas-alunos" width="150" height="80" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                        <span id="alunos" class="gauge-value gauge-text text-center"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Total de Reservas de Recursos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content text-center">
                    <canvas id="canvas-reserva-recursos" width="150" height="80" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                        <span id="reserva-recursos" class="gauge-value gauge-text text-center"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Total de Reservas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content text-center">
                    <canvas id="canvas-reservas" width="150" height="80" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                        <span id="reservas" class="gauge-value gauge-text text-center"></span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Livros mais lidos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(isset($publicacoes) && count($publicacoes) > 0)
                        @foreach($publicacoes as $p)
                            <article class="media event">
                                <a class="pull-left" style="font-size: 30px">
                                    <i class="fa fa-book blue"></i>
                                </a>
                                <div class="media-body">
                                    <p class="title"><strong>{{ $p->codigo }}</strong></p>
                                    <p>{{ $p->titulo }}</p>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p>O sistema ainda não possui nenhuma publicação emprestada!</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pessoas que mais leêm</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(isset($pessoas) && count($pessoas) > 0)
                        @foreach($pessoas as $p)
                            <article class="media event">
                                <a class="pull-left" style="font-size: 30px">
                                    <i class="fa fa-user blue"></i>
                                </a>
                                <div class="media-body">
                                    <p class="title"><strong>{{ $p->nome }}</strong></p>
                                    <p>{{ $p->email }}</p>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p>O sistema ainda não possui nenhum empréstimo relacionado!</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h2>Recursos mais reservados</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(isset($recursos) && count($recursos) > 0)
                        @foreach($recursos as $r)
                            <div class="widget_summary">
                                <div class="w_left w_40">
                                    <span>{{ str_limit($r->descricao, 20) }}</span>
                                </div>
                                <div class="w_center w_55">
                                    <div class="progress">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="{{ $r->percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $r->percentage }}%;">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="w_right w_10">
                                    <span>{{ $r->total }}</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endforeach
                    @else
                        <p>O sistema ainda não possui recursos reservados!</p>
                    @endif
                </div>
            </div>
        </div>

    </div>


@endsection
@section('scripts')
    <script src="{{asset('assets/js/gauge.min.js')}}"></script>
    <script>
        var opts = {
            lines: 12,
            angle: 0,
            lineWidth: 0.4,
            pointer: {
                length: 0.80,
                strokeWidth: 0.060,
                color: '#1D212A'
            },
            limitMax: 'false',
            colorStart: '#3498DB',
            colorStop: '#3498DB',
            strokeColor: '#F0F3F3',
            generateGradient: true
        };

        var livros = document.getElementById('canvas-livros');
        var emprestimos = document.getElementById('canvas-emprestimos');
        var reservaRecursos = document.getElementById('canvas-reserva-recursos');
        var alunos = document.getElementById('canvas-alunos');
        var revistas = document.getElementById('canvas-revistas');
        var reservas = document.getElementById('canvas-reservas');

        var gaugeLivro = new Gauge(livros).setOptions(opts);
        var gaugeEmprestimo = new Gauge(emprestimos).setOptions(opts);
        var gaugeReservaRecurso = new Gauge(reservaRecursos).setOptions(opts);
        var gaugeAluno = new Gauge(alunos).setOptions(opts);
        var gaugeRevistas = new Gauge(revistas).setOptions(opts);
        var gaugeReservas = new Gauge(reservas).setOptions(opts);

        gaugeLivro.maxValue = {{$livros + 200}};
        gaugeLivro.animationSpeed = 40;
        gaugeLivro.set({{$livros ? $livros : 0}});
        gaugeLivro.setTextField(document.getElementById("livros"));

        gaugeEmprestimo.maxValue = {{$emprestimos + 200}};
        gaugeEmprestimo.animationSpeed = 40;
        gaugeEmprestimo.set({{$emprestimos ? $emprestimos : 0}});
        gaugeEmprestimo.setTextField(document.getElementById("emprestimos"));

        gaugeReservaRecurso.maxValue = {{$reservaRecurso + 200}};
        gaugeReservaRecurso.animationSpeed = 40;
        gaugeReservaRecurso.set({{$reservaRecurso ? $reservaRecurso : 0}});
        gaugeReservaRecurso.setTextField(document.getElementById("reserva-recursos"));

        gaugeAluno.maxValue = {{$alunos + 200}};
        gaugeAluno.animationSpeed = 40;
        gaugeAluno.set({{$alunos ? $alunos : 0}});
        gaugeAluno.setTextField(document.getElementById("alunos"));

        gaugeRevistas.maxValue = {{$revistas + 200}};
        gaugeRevistas.animationSpeed = 40;
        gaugeRevistas.set({{$revistas ? $revistas : 0}});
        gaugeRevistas.setTextField(document.getElementById("revistas"));

        gaugeReservas.maxValue = {{$reservas + 200}};
        gaugeReservas.animationSpeed = 40;
        gaugeReservas.set({{$reservas ? $reservas : 0}});
        gaugeReservas.setTextField(document.getElementById("reservas"));
    </script>
@endsection