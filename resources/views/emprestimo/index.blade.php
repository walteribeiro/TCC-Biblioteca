@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Empréstimos
        <a href="{{ route('emprestimo.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

    @if(isset($emprestimos) && count($emprestimos) > 0)
        <table id="emprestimos" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Data Empréstimo</th>
                <th>Data Devolução</th>
                <th>Data Prevista</th>
                <th>Situação</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($emprestimos as $e)
                <tr>
                    <td>{{$e->id}}</td>
                    <td>{{$e->user->nome}}</td>
                    <td>{{$e->data_emprestimo}}</td>
                    <td>{{$e->data_devolucao}}</td>
                    <td>{{date('d/m/Y', strtotime($e->data_prevista))}}</td>
                    <td>
                        @if($e->situacao == 0)
                            <span class="label label-success">
                                Em Aberto
                            </span>
                        @else
                            <span class="label label-primary">
                                Devolvido
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($e->situacao == 0)
                            <a href="#devolver" class="btn btn-sm btn-primary"
                               data-devolver="{{ $e->data_emprestimo }}"
                               data-id="{{ $e->id }}">
                                <em class="fa fa-ban"></em> Devolver
                            </a>
                        @else
                            <button disabled class="btn btn-sm btn-primary">
                                <em class="fa fa-ban"></em> Devolver
                            </button>
                        @endif
                        <a href="#show" class="btn btn-sm btn-success"
                           data-situacao="{{ $e->situacao}}"
                           data-data_emprestimo="{{ $e->data_emprestimo}}"
                           data-data_devolucao="{{ $e->data_devolucao }}"
                           data-data_prevista="{{ $e->data_prevista }}">
                            <em class="fa fa-search"></em> Visualizar
                        </a>
                            @if($e->situacao == 0)
                                <a href="{{ route('emprestimo.edit', $e->id)}}" class="btn btn-sm btn-warning">
                                    <em class="fa fa-pencil"></em> Alterar
                                </a>
                                <a href="#modal" class="btn btn-sm btn-danger"
                                   data-delete="{{ $e->data_emprestimo }}"
                                   data-id="{{ $e->id }}">
                                    <em class="fa fa-trash-o"></em> Excluir
                                </a>
                            @else
                                <button disabled class="btn btn-sm btn-warning">
                                    <em class="fa fa-pencil"></em> Alterar
                                </button>
                                <button disabled class="btn btn-sm btn-danger">
                                    <em class="fa fa-trash-o"></em> Excluir
                                </button>
                            @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram efetuados empréstimos!</h5>
    @endif

    @include('layout.delete-modal')

    @include('layout.show-modal')

    <div class="modal fade" id="devolver-modal" role="dialog" data-backdrop="static">
        <form action="" id="formdevolver" method="post">
            {{ method_field('put') }}
            {!! csrf_field() !!}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Devolução</h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <em class="fa fa-undo"></em> Voltar
                        </button>
                        <button type="submit" class="btn btn-dark">
                            <em class="fa fa-ban"></em> Devolver
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('scripts')

    @include('layout.includes.return-request')

    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            var deleteLogModal = $('div#delete-modal');

            $("a[href='#modal']").click(function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                var data = $(this).data('delete');

                deleteLogModal.find('.modal-body p').html(
                        'Você tem certeza que deseja excluir o empréstimo do dia ' + data + ' ?'
                );

                $('#formexcluir').attr("action", "emprestimos/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(function (){
            var showModal = $('div#show-modal');

            $("a[href='#show']").click(function(event) {
                event.preventDefault();
                var situacao = $(this).data('situacao');
                var data_emprestimo = $(this).data('data_emprestimo');
                var data_prevista = moment($(this).data('data_prevista'), 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
                var data_devolucao = $(this).data('data_devolucao');

                showModal.find('.modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-3">Data empréstimo:</div>' +
                        '<div class="col-md-9"><p>'+ data_emprestimo + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-3">Data prevista:</div>' +
                        '<div class="col-md-9"><p>'+ data_prevista + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-3">Data devolução:</div>' +
                        '<div class="col-md-9"><p>'+ (data_devolucao ? data_devolucao : "&nbsp") + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-3">Situação:</div>' +
                        '<div class="col-md-9"><p>'+ (situacao == 0 ? "Em Aberto" : "Devolvido") + '</p></div>' +
                        '</div>'
                );

                showModal.modal('show');
            });
        });

        $(function () {
            var devolverModal = $('div#devolver-modal');

            $("a[href='#devolver']").click(function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                var data = $(this).data('devolver');

                devolverModal.find('.modal-body p').html(
                        'Você tem certeza que deseja devolver o empréstimo do dia ' + data + ' ?'
                );

                $('#formdevolver').attr("action", "emprestimos/devolver/"+id);
                devolverModal.modal('show');
            });
        });

        $(function () {
            $('#emprestimos').DataTable({
                "stateSave": true,
                "pagingType": "full_numbers",
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_  Resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar ",
                    "oPaginate": {
                        "sNext": ">",
                        "sPrevious": "<",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });
        });
    </script>
@endsection