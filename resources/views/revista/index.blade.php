@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Revistas
        <a href="{{ route('revista.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

    @if(isset($revistas) && count($revistas) > 0)
        <table id="revistas" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Edição</th>
                <th>Categoria</th>
                <th>Status</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($revistas as $l)
                <tr>
                    <td>{{$l->publicacao->codigo}}</td>
                    <td>{{$l->publicacao->titulo}}</td>
                    <td>{{$l->publicacao->edicao}}</td>
                    <td>{{$l->categoria}}</td>
                    <td>
                        @if($l->publicacao->status == 0)
                            <span class="label label-success">
                                Disponível
                            </span>
                        @elseif($l->publicacao->status == 1)
                            <span class="label label-danger">
                                Indisponível
                            </span>
                        @else
                            <span class="label label-dark">
                                Desativado
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="#show" class="btn btn-sm btn-success"
                           data-titulo="{{ $l->publicacao->titulo }}"
                           data-referencia="{{ $l->referencia }}"
                           data-categoria="{{ $l->categoria }}"
                           data-origem="{{ $l->publicacao->origem }}"
                           data-descricao="{{ $l->publicacao->descricao }}"
                           data-editora="{{ $l->publicacao->editora->nome }}"
                           data-edicao="{{ $l->publicacao->edicao }}">
                            <em class="fa fa-search"></em> Visualizar
                        </a>
                        <a href="{{ route('revista.edit', $l->publicacao_id)}}" class="btn btn-sm btn-warning">
                            <em class="fa fa-pencil"></em> Alterar
                        </a>
                        <a href="#modal" class="btn btn-sm btn-danger"
                           data-delete="{{ $l->publicacao->titulo }}"
                           data-id="{{ $l->publicacao->id }}">
                            <em class="fa fa-trash-o"></em> Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastradas revistas!</h5>
        @endif

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

            $("a[href='#modal']").click(function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                var titulo = $(this).data('delete');

                deleteLogModal.find('.modal-body p').html(
                        'Você tem certeza que deseja excluir a revista ' + titulo.toUpperCase() + ' ?'
                );

                $('#formexcluir').attr("action", "revistas/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(function (){
            var showModal = $('div#show-modal');

            $("a[href='#show']").click(function(event) {
                event.preventDefault();
                var titulo = $(this).data('titulo');
                var referencia = $(this).data('referencia');
                var categoria = $(this).data('categoria');
                var origem = $(this).data('origem');
                var descricao = $(this).data('descricao');
                var editora = $(this).data('editora');
                var edicao = $(this).data('edicao');

                console.log(origem);

                showModal.find('.modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-2">Título:</div>' +
                        '<div class="col-md-10"><p>'+ titulo + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Referência:</div>' +
                        '<div class="col-md-10"><p>'+ referencia + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Categoria:</div>' +
                        '<div class="col-md-10"><p>'+ categoria + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Origem:</div>' +
                        '<div class="col-md-10"><p>'+ (origem == "" ? "&nbsp;" : origem) + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Descrição:</div>' +
                        '<div class="col-md-10"><p>'+ descricao + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Editora:</div>' +
                        '<div class="col-md-10"><p>'+ editora + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Edição:</div>' +
                        '<div class="col-md-10"><p>'+ edicao + '</p></div>' +
                        '</div>'
                );

                showModal.modal('show');
            });
        });

        $(function () {
            $('#revistas').DataTable({
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