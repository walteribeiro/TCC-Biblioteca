@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Turmas <a href="{{ route('turma.create') }}" class="btn btn-primary pull-right">Novo</a></h3>
    @if(isset($turmas) && count($turmas) > 0)
        <table id="turmas" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Série</th>
                <th>Letra</th>
                <th>Turno</th>
                <th>Ano</th>
                <th>Ensino</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($turmas as $t)

                <tr>
                    <td>{{$t->serie}}</td>
                    <td>{{$t->letra_turma}}</td>
                    <td>{{$t->turno}}</td>
                    <td>{{$t->ano}}</td>
                    <td>{{$t->ensino}}</td>
                    <td class="text-center">
                        <a href="#show" class="btn btn-sm btn-success"
                           data-serie="{{ $t->serie }}"
                           data-letra_turma="{{ $t->letra_turma }}"
                           data-turno="{{ $t->turno }}"
                           data-ano="{{ $t->ano }}"
                           data-ensino="{{ $t->ensino }}">
                            <span class="glyphicon glyphicon-search"></span>
                        </a>
                        <a href="{{ route('turma.edit', $t->id)}}" class="btn btn-sm btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="#modal" class="btn btn-sm btn-danger"
                           data-delete="{{ $t->serie }}" data-code="{{ $t->letraTurma }}"
                           data-id="{{ $t->id }}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastradas turmas!</h5>
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
                        'Você tem certeza que deseja <span class="label label-danger">EXCLUIR</span> a turma <br><br><span class="label label-primary">' + descricao.toUpperCase() + ' - ' + subtitulo.toUpperCase() + '</span> ?'
                );

                $('#formexcluir').attr("action", "turmas/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(function (){
            var showModal = $('div#show-modal');

            $("a[href='#show']").click(function(event) {
                event.preventDefault();
                var serie = $(this).data('serie');
                var letra_turma = $(this).data('letra_turma');
                var turno = $(this).data('turno');
                var ano = $(this).data('ano');
                var ensino = $(this).data('ensino');


                showModal.find('.modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-2">Série:</div>' +
                        '<div class="col-md-10"><p>'+ serie + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Letra:</div>' +
                        '<div class="col-md-10"><p>'+ letra_turma + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Turno:</div>' +
                        '<div class="col-md-10"><p>'+ turno + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Ano:</div>' +
                        '<div class="col-md-10"><p>'+ ano + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Ensino:</div>' +
                        '<div class="col-md-10"><p>'+ ensino + '</p></div>'
                );

                showModal.modal('show');
            });
        });

        $(document).ready(function () {
            $('#turmas').DataTable({
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