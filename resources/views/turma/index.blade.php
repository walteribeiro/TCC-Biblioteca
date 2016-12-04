@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Turmas
        <a href="{{ route('turma.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

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
                    <td>
                        @if($t->turno == 0)
                            Manhã
                        @elseif($t->turno == 1)
                            Tarde
                        @elseif($t->turno == 2)
                            Noite
                        @endif
                    </td>
                    <td>{{$t->ano}}</td>
                    <td>
                        @if($t->ensino == 0)
                            Fundamental
                        @elseif($t->ensino == 1)
                            Médio
                        @elseif($t->ensino == 2)
                            Superior
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('turma.vinculo', $t->id) }}" class="btn btn-sm btn-primary">
                            <em class="fa fa-plus-circle"></em> Adicionar Alunos
                        </a>
                        <a href="#show" class="btn btn-sm btn-success"
                           data-serie="{{ $t->serie }}"
                           data-letra_turma="{{ $t->letra_turma }}"
                           data-turno="{{ $t->turno }}"
                           data-ano="{{ $t->ano }}"
                           data-ensino="{{ $t->ensino }}">
                            <em class="fa fa-search"></em> Visualizar
                        </a>
                        <a href="{{ route('turma.edit', $t->id)}}" class="btn btn-sm btn-warning">
                            <em class="fa fa-pencil"></em> Alterar
                        </a>
                        <a href="#modal" class="btn btn-sm btn-danger"
                           data-delete="{{ $t->serie }}"
                           data-code="{{ $t->letra_turma }}"
                           data-ano="{{ $t->ano}}"
                           data-id="{{ $t->id }}">
                            <em class="fa fa-trash-o"></em> Excluir
                        </a>
                        <a href="{{ route('turma.aluno', $t->id) }}" class="btn btn-sm btn-dark">
                            <em class="fa fa-graduation-cap"></em> Remover Alunos <em class="badge">{{ $t->alunos->count() }}</em>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastradas turmas!</h5>
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
                var serie = $(this).data('delete');
                var letra = $(this).data('code');
                var ano = $(this).data('ano');

                deleteLogModal.find('.modal-body p').html(
                        'Você tem certeza que deseja excluir a turma ' + serie + ' - ' + letra + ' de ' + ano +' ?'
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

                var descricaoTurno = '';
                var descricaoEnsino = '';
                switch (turno){
                    case 0:
                        descricaoTurno = 'Manhã';
                        break;
                    case 1:
                        descricaoTurno = 'Tarde';
                        break;
                    case 2:
                        descricaoTurno = 'Noite';
                        break;
                }

                switch (ensino){
                    case 0:
                        descricaoEnsino = 'Fundamental';
                        break;
                    case 1:
                        descricaoEnsino = 'Médio';
                        break;
                    case 2:
                        descricaoEnsino = 'Superior';
                        break;
                }

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
                        '<div class="col-md-10"><p>'+ descricaoTurno + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-2">Ano:</div>' +
                        '<div class="col-md-10"><p>'+ ano + '</p></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-2">Ensino:</div>' +
                        '<div class="col-md-10"><p>'+ descricaoEnsino + '</p></div>'
                );

                showModal.modal('show');
            });
        });

        $(function () {
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