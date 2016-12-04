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
                <th>Nº Matrícula</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Situação</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alunos as $f)
                <tr>
                    <td>{{$f->matricula}}</td>
                    <td>{{$f->user->nome}}</td>
                    <td>{{$f->user->telefone}}</td>
                    <td>{{$f->user->email}}</td>
                    <td>
                        @if($f->user->ativo == 1)
                            Ativo
                        @else
                            Inativo
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="#show" class="btn btn-sm btn-success"
                           data-nome="{{ $f->user->nome }}"
                           data-telefone="{{ $f->user->telefone }}"
                           data-telefone2="{{ $f->user->telefone2 }}"
                           data-email="{{ $f->user->email }}"
                           data-registro="{{ $f->matricula }}"
                           data-ativo="{{ $f->user->ativo }}">
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
                        @if(Auth::check())
                            @if(Auth::user()->tipo_acesso == 0)
                                <a href="#pass" class="btn btn-sm btn-dark"
                                   data-id="{{ $f->user->id }}">
                                    <em class="fa fa-unlock"></em> Alterar Senha
                                </a>
                            @else
                                <a href="#" disabled class="btn btn-sm btn-dark">
                                    <em class="fa fa-unlock"></em> Alterar Senha
                                </a>
                            @endif
                        @endif
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

    @include('layout.change-password-modal')

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
                        'Você tem certeza que deseja excluir o aluno ' + nome + ' ?'
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
                var telefone = $(this).data('telefone');
                var telefone2 = $(this).data('telefone2');
                var email = $(this).data('email');
                var registro = $(this).data('registro');
                var ativo = $(this).data('ativo');

                showModal.find('.modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-2">Nome:</div>' +
                        '<div class="col-md-10"><p>'+ nome + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Telefone:</div>' +
                        '<div class="col-md-10"><p>'+ (telefone ? telefone : "&nbsp") + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Celular:</div>' +
                        '<div class="col-md-10"><p>'+ (telefone2 ? telefone2 : "&nbsp") + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Email:</div>' +
                        '<div class="col-md-10"><p>'+ (email ? email : "&nbsp") + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Nº Matrícula:</div>' +
                        '<div class="col-md-10"><p>'+ registro + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Status:</div>' +
                        '<div class="col-md-10"><p>'+ (ativo == 1 ? "Ativo" : "Inativo") + '</p></div>' +
                        '</div>'
                );

                showModal.modal('show');
            });
        });

        $(function () {
            var passwordModal = $('div#change-password-modal');

            $("a[href='#pass']").click(function(event) {
                event.preventDefault();
                var id = $(this).data('id');

                passwordModal.find('.modal-body p').html(
                        '<input type="hidden" value="'+id+'" name="user-id">'
                );
                passwordModal.modal('show');
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