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

    <table id="emprestimos-table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Data Empréstimo</th>
            <th>Data Devolução</th>
            <th>Data Prevista</th>
            <th>Situação</th>
            <th>Opções</th>
        </tr>
        </thead>
    </table>

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

            $('#emprestimos-table').on('click', 'a[href="#modal"]', function (event) {
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

            $('#emprestimos-table').on('click', 'a[href="#show"]', function (event) {
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

            $('#emprestimos-table').on('click', 'a[href="#devolver"]', function (event) {
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#emprestimos-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '{!! route('emprestimo.getAll') !!}'
                },
                pagingType: "full_numbers",
                language: {
                    sEmptyTable: "Nenhum registro encontrado",
                    sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
                    sInfoFiltered: "(Filtrados de _MAX_ registros)",
                    sInfoPostFix: "",
                    sInfoThousands: ".",
                    sLengthMenu: "_MENU_  Resultados por página",
                    sLoadingRecords: "Carregando...",
                    sProcessing: '<div class="progress" style="height: 38px;width: 250px;margin-top: -8px;border-radius: 3px;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="width: 100%;line-height: 36px;"><span>Processando ...</span></div></div>',
                    sZeroRecords: "Nenhum registro encontrado",
                    sSearch: "Pesquisar ",
                    oPaginate: {
                        sNext: ">",
                        sPrevious: "<",
                        sFirst: "Primeiro",
                        sLast: "Último"
                    },
                    oAria: {
                        sSortAscending: ": Ordenar colunas de forma ascendente",
                        sSortDescending: ": Ordenar colunas de forma descendente"
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nome', name: 'nome', width: '30%'},
                    {data: 'data_emprestimo', name: 'data_emprestimo'},
                    {data: 'data_devolucao', name: 'data_devolucao'},
                    {data: 'data_prevista', name: 'data_prevista'},
                    {data: 'situacao', name: 'situacao'},
                    {data: 'action', name: 'action', width: '30%', orderable: false, searchable: false}
                ],
                createdRow: function ( row, data, index ) {
                    $('td', row).eq(6).addClass('text-center');
                    $('td', row).eq(4)[0].innerHTML = moment(data.data_prevista, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
                }
            });
        });
    </script>
@endsection