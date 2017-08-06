@extends('layout.main')

@section('conteudo')

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Relatório de Funcionários que Efetuam mais Empréstimos</h2>
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
                                        <th>Nº Registro</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>Celular</th>
                                        <th>Email</th>
                                        <th>Total de Empréstimos</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($funcionarios as $f)
                                        <tr>
                                            <td>{{ $f->matricula }}</td>
                                            <td>{{ $f->nome }}</td>
                                            <td>{{ $f->telefone }}</td>
                                            <td>{{ $f->telefone2 }}</td>
                                            <td>{{ $f->email }}</td>
                                            <td>{{ $f->total }}</td>
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
                                @if(isset($funcionarios) && count($funcionarios) > 0)
                                <a target="_blank" href="{{ route('funcionario.emprestimo.pdf') }}" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Gerar PDF</a>
                                <a href="{{ route('funcionario.emprestimo.baixar') }}" class="btn btn-dark pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Baixar PDF</a>
                                @else
                                    <a href="#" disabled class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Gerar PDF</a>
                                    <a href="#" disabled class="btn btn-dark pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Baixar PDF</a>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection