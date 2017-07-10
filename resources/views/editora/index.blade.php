@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Editoras
        <a href="{{ route('editora.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

    <table id="editoras-table" class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
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

            $('#editoras-table').on('click', 'a[href="#modal"]', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                var nome = $(this).data('delete');

                deleteLogModal.find('.modal-body p').html(
                        'Você tem certeza que deseja excluir a editora ' + nome + ' ?'
                );

                $('#formexcluir').attr("action", "editoras/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(function (){
            var showModal = $('div#show-modal');

            $('#editoras-table').on('click', 'a[href="#show"]', function (event) {
                event.preventDefault();
                var nome = $(this).data('nome');

                showModal.find('.modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-2">Nome:</div>' +
                        '<div class="col-md-10"><p>'+ nome + '</p></div>' +
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
            $('#editoras-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '{!! route('editora.getAll') !!}'
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
                    {data: 'id', name: 'id', width: '10%'},
                    {data: 'nome', name: 'nome', width: '60%'},
                    {data: 'action', name: 'action', width: '30%', orderable: false, searchable: false}
                ],
                createdRow: function ( row, data, index ) {
                    $('td', row).eq(2).addClass('text-center');
                }
            });
        });
    </script>
@endsection