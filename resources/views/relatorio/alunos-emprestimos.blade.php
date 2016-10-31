@extends('layout.main')

@section('conteudo')

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Relatório de Alunos que Efetuam mais Empréstimos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <section class="content invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12 invoice-header">
                                <h1>
                                    <i class="fa fa-institution"></i> Escola Estadual Antônio Carlos
                                    <small class="pull-right">Data: {{$dataEmissao}}</small>
                                </h1>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <br><br><br><br><br><br>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Matrícula</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>Celular</th>
                                        <th>Email</th>
                                        <th>Total de Empréstimos</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($alunos as $a)
                                        <tr>
                                            <td>{{ $a->matricula }}</td>
                                            <td>{{ $a->nome }}</td>
                                            <td>{{ $a->telefone }}</td>
                                            <td>{{ $a->telefone2 }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->total }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <br><br><br>

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <a target="_blank" href="{{ route('aluno.emprestimo.pdf') }}" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Gerar PDF</a>
                                <a href="{{ route('aluno.emprestimo.baixar') }}" class="btn btn-dark pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Baixar PDF</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection