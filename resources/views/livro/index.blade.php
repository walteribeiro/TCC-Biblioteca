@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Livros
        <a href="{{ route('livro.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

    <table id="livros-table" class="table table-bordered">
        <thead>
        <tr>
            <th>Código</th>
            <th>Título</th>
            <th>Edição</th>
            <th>Ano</th>
            <th>Status</th>
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

            $('#livros-table').on('click', 'a[href="#modal"]', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                var titulo = $(this).data('delete');

                deleteLogModal.find('.modal-body p').html(
                        'Você tem certeza que deseja excluir o livro ' + titulo + ' ?'
                );

                $('#formexcluir').attr("action", "livros/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(function (){
            var showModal = $('div#show-modal');

            $('#livros-table').on('click', 'a[href="#show"]', function (event) {
                event.preventDefault();
                var titulo = $(this).data('titulo');
                var subtitulo = $(this).data('subtitulo');
                var descricao = $(this).data('descricao');
                var editora = $(this).data('editora');
                var autor = $(this).data('autor');
                var edicao = $(this).data('edicao');
                var origem = $(this).data('origem');
                var ano = $(this).data('ano');
                var isbn = $(this).data('isbn');
                var cdu = $(this).data('cdu');
                var cdd = $(this).data('cdd');

                showModal.find('.modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-2">Título:</div>' +
                        '<div class="col-md-10"><p>'+ titulo + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Subtitulo:</div>' +
                        '<div class="col-md-10"><p>'+ (subtitulo ? subtitulo : "&nbsp") + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Descrição:</div>' +
                        '<div class="col-md-10"><p>'+ (descricao ? descricao : "&nbsp") + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Editora:</div>' +
                        '<div class="col-md-10"><p>'+ editora + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Autor:</div>' +
                        '<div class="col-md-10"><p>'+ autor + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Edição:</div>' +
                        '<div class="col-md-10"><p>'+ edicao + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Origem:</div>' +
                        '<div class="col-md-2"><p>'+ (origem ? origem : "&nbsp") + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Ano:</div>' +
                        '<div class="col-md-2"><p>'+ ano + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">ISBN:</div>' +
                        '<div class="col-md-2"><p>'+ (isbn ? isbn : "&nbsp") + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">CDU:</div>' +
                        '<div class="col-md-2"><p>'+ (cdu ? cdu : "&nbsp") + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">CDD:</div>' +
                        '<div class="col-md-2"><p>'+ (cdd ? cdd : "&nbsp") + '</p></div>' +
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
            $('#livros-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '{!! route('livro.getAll') !!}'
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
                    {data: 'codigo', name: 'codigo'},
                    {data: 'titulo', name: 'titulo', width: '30%'},
                    {data: 'edicao', name: 'edicao'},
                    {data: 'ano', name: 'ano'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', width: '30%', orderable: false, searchable: false}
                ],
                createdRow: function ( row, data, index ) {
                    $('td', row).eq(5).addClass('text-center');
                }
            });
        });
    </script>
@endsection