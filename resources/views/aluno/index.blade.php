@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Alunos <a href="{{ route('aluno.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
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
                        <a href="#show" class="btn btn-sm btn-success">
                            <em class="fa fa-pencil"></em> Visualizar
                        </a>
                        <a href="{{ route('aluno.edit', $f->user_id)}}" class="btn btn-sm btn-warning">
                            <em class="fa fa-pencil"></em> Alterar
                        </a>
                        <a href="#modal" class="btn btn-sm btn-danger"
                           data-delete="{{ $f->user->nome }}"
                           data-id="{{ $f->user->id }}">
                            <em class="fa fa-trash-o"></em> Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastrados alunos!</h5>
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
                var nome = $(this).data('delete');

                deleteLogModal.find('.modal-body p').html(
                        'Você tem certeza que deseja excluir o aluno ' + nome.toUpperCase() + ' ?'
                );

                $('#formexcluir').attr("action", "alunos/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(function (){
            var showModal = $('div#show-modal');

            $("a[href='#show']").click(function(event) {
                event.preventDefault();
                var nome = $(this).data('nome');
                var sobrenome = $(this).data('sobrenome');

                showModal.find('.modal-body').html(
                        'Autor: ' + nome + ' ' + sobrenome
                );

                showModal.modal('show');
            });
        });

        $(function () {
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