@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Alunos <a href="{{ route('aluno.create') }}" class="btn btn-primary pull-right">Novo</a>
    </h3>

    @if(isset($alunos) && count($alunos) > 0)
        <table id="alunos" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Matrícula</th>
                <th>Situação</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alunos as $f)
                <tr>
                    <td>{{$f->user->id}}</td>
                    <td>{{$f->user->nome}}</td>
                    <td>{{$f->user->telefone}}</td>
                    <td>{{$f->user->email}}</td>
                    <td>{{$f->matricula}}</td>
                    <td>
                        @if($f->user->ativo == 1)
                            Ativo
                        @else
                            Inativo
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('aluno.edit', $f->id)}}" class="btn btn-sm btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#modal" class="btn btn-sm btn-danger" data-delete="{{ $f->user->nome }}" data-id="{{ $f->user->id }}">
                            <span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastrados alunos!</h5>
        @endif

                <!-- Modal Exclusão -->
        <div class="modal fade" id="delete-log-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="" method="post" id="formexcluir">
                {{ method_field('delete') }}
                {!! csrf_field() !!}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
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
                var nome = $(this).data('delete');

                deleteLogModal.find('.modal-body h5').html(
                        'Você tem certeza que deseja <span class="label label-danger">EXCLUIR</span> o aluno <br><br><span class="label label-primary">' + nome.toUpperCase() + '</span> ?'
                );

                $('#formexcluir').attr("action", "alunos/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(document).ready(function () {
            $('#alunos').DataTable({
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