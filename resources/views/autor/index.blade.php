@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Autores
        <a href="{{ route('autor.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

    <table id="autores-table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Opções</th>
        </tr>
        </thead>
    </table>

    @include('layout.delete-modal')

    @include('layout.show-modal')

@endsection
@section('scripts')

    @include('layout.includes.return-request')

    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            var deleteLogModal = $('div#delete-modal');

            $('#autores-table').on('click', 'a[href="#modal"]', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                var nome = $(this).data('delete');

                deleteLogModal.find('.modal-body p').html(
                    'Você tem certeza que deseja excluir o autor ' + nome + ' ?'
                );

                $('#formexcluir').attr("action", "autores/remover/" + id);
                deleteLogModal.modal('show');
            });
        });

        $(function () {
            var showModal = $('div#show-modal');

            $('#autores-table').on('click', 'a[href="#show"]', function (event) {
                event.preventDefault();
                var nome = $(this).data('nome');
                var sobrenome = $(this).data('sobrenome');

                showModal.find('.modal-body').html(
                    '<div class="row">' +
                    '<div class="col-md-2">Nome:</div>' +
                    '<div class="col-md-10"><p>' + nome + '</p></div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-2">Sobrenome:</div>' +
                    '<div class="col-md-10"><p>' + sobrenome + '</p></div>' +
                    '</div>'
                );

                showModal.modal('show');
            });
        });

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#autores-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '{!! route('autor.getAll') !!}'
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
                    {data: 'sobrenome', name: 'sobrenome', width: '30%'},
                    {data: 'action', name: 'action', width: '30%', orderable: false, searchable: false}
                ],
                createdRow: function (row, data, index) {
                    $('td', row).eq(3).addClass('text-center');
                }
            });
        });
    </script>
@endsection