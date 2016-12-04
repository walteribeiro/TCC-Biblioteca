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

    @if(isset($livros) && count($livros) > 0)
        <table id="livros" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Código</th>
                <th style="width: 30%">Título</th>
                <th>Subtitulo</th>
                <th>Edição</th>
                <th>Ano</th>
                <th>Status</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($livros as $l)
                <tr>
                    <td>{{$l->publicacao->codigo}}</td>
                    <td>{{$l->publicacao->titulo}}</td>
                    <td>{{$l->subtitulo}}</td>
                    <td>{{$l->publicacao->edicao}}</td>
                    <td>{{$l->ano}}</td>
                    <td>
                        @if($l->publicacao->status == 0)
                            <span class="label label-dark">
                                Desativado
                            </span>
                        @elseif($l->publicacao->status == 1)
                            <span class="label label-success">
                                Disponível
                            </span>
                        @elseif($l->publicacao->status == 2)
                            <span class="label label-primary">
                                Emprestado
                            </span>
                        @else
                            <span class="label label-warning">
                                Reservado
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="#show" class="btn btn-sm btn-success"
                           data-titulo="{{ $l->publicacao->titulo }}"
                           data-subtitulo="{{ $l->subtitulo }}"
                           data-descricao="{{ $l->publicacao->descricao }}"
                           data-editora="{{ $l->publicacao->editora->nome }}"
                           data-autor="{{ $l->autor->nome }}"
                           data-edicao="{{ $l->publicacao->edicao }}"
                           data-origem="{{ $l->publicacao->origem }}"
                           data-ano="{{ $l->ano }}"
                           data-isbn="{{ $l->isbn }}"
                           data-cdu="{{ $l->cdu }}"
                           data-cdd="{{ $l->cdd }}">
                            <em class="fa fa-search"></em> Visualizar
                        </a>
                        @if($l->publicacao->status != 0 && $l->publicacao->status != 1)
                            <button disabled class="btn btn-sm btn-warning">
                                <em class="fa fa-pencil"></em> Alterar
                            </button>

                            <button disabled class="btn btn-sm btn-danger">
                                <em class="fa fa-trash-o"></em> Excluir
                            </button>
                        @else
                            <a href="{{ route('livro.edit', $l->publicacao_id)}}" class="btn btn-sm btn-warning">
                                <em class="fa fa-pencil"></em> Alterar
                            </a>

                            <a href="#modal" class="btn btn-sm btn-danger"
                               data-delete="{{ $l->publicacao->titulo }}"
                               data-code="{{ $l->subtitulo }}"
                               data-id="{{ $l->publicacao->id }}">
                                <em class="fa fa-trash-o"></em> Excluir
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastrados livros!</h5>
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
                        'Você tem certeza que deseja excluir o livro ' + titulo + ' ?'
                );

                $('#formexcluir').attr("action", "livros/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(function (){
            var showModal = $('div#show-modal');

            $("a[href='#show']").click(function(event) {
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
            $('#livros').DataTable({
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