@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Livros <a href="{{ route('livro.create') }}" class="btn btn-primary pull-right">Novo</a></h3>

    @if(isset($livros) && count($livros) > 0)
        <table id="livros" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Subtitulo</th>
                <th>Edição</th>
                <th>Ano</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($livros as $l)
                <tr>
                    <td>{{$l->publicacao->id}}</td>
                    <td>{{$l->publicacao->titulo}}</td>
                    <td>{{$l->subtitulo}}</td>
                    <td>{{$l->publicacao->edicao}}</td>
                    <td>{{$l->ano}}</td>
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
                            <span class="glyphicon glyphicon-search"></span>
                        </a>
                        <a href="{{ route('livro.edit', $l->id)}}" class="btn btn-sm btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="#modal" class="btn btn-sm btn-danger"
                           data-delete="{{ $l->publicacao->titulo }}" data-code="{{ $l->subtitulo }}"
                           data-id="{{ $l->publicacao->id }}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastrados livros!</h5>
        @endif

                <!-- Modal Exclusão -->
        <div class="modal fade" id="delete-log-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="" method="post" id="formexcluir">
                {{ method_field('delete') }}
                {!! csrf_field() !!}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Exclusão</h4>
                        </div>
                        <div class="modal-body">
                            <h5></h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Fim Modal Exclusão -->

    @include('layout.show-modal')

@endsection
@section('scripts')

    @include('layout.includes.return-request')

    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal');

            $("a[href='#modal']").click(function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                var descricao = $(this).data('delete');
                var subtitulo = $(this).data('code');

                deleteLogModal.find('.modal-body h5').html(
                        'Você tem certeza que deseja <span class="label label-danger">EXCLUIR</span> o livro <br><br><span class="label label-primary">' + descricao.toUpperCase() + ' - ' + subtitulo.toUpperCase() + '</span> ?'
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
                        '<div class="col-md-10"><p>'+ subtitulo + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Descrição:</div>' +
                        '<div class="col-md-10"><p>'+ descricao + '</p></div>' +
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
                        '<div class="col-md-2"><p>'+ origem + '</p></div>' +
                        '<div class="col-md-1">Ano:</div>' +
                        '<div class="col-md-2"><p>'+ ano + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">ISBN:</div>' +
                        '<div class="col-md-2"><p>'+ isbn + '</p></div>' +
                        '<div class="col-md-1">CDU:</div>' +
                        '<div class="col-md-2"><p>'+ cdu + '</p></div>' +
                        '<div class="col-md-1">CDD:</div>' +
                        '<div class="col-md-2"><p>'+ cdd + '</p></div>' +
                        '</div>'
                );

                showModal.modal('show');
            });
        });

        $(document).ready(function () {
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
                    "sLengthMenu": "_MENU_  resultados por página",
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