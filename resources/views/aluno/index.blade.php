@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Alunos <a href="{{ route('aluno.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

    <table id="alunos-table" class="table table-bordered">
        <thead>
        <tr>
            <th>Nº Matrícula</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Situação</th>
            <th>Opções</th>
        </tr>
        </thead>
    </table>

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
            $('#alunos-table').on('click', 'a[href="#modal"]', function (event) {
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
            $('#alunos-table').on('click', 'a[href="#show"]', function (event) {
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
            $('#alunos-table').on('click', 'a[href="#pass"]', function (event) {
                event.preventDefault();
                var id = $(this).data('id');

                passwordModal.find('.modal-body p').html(
                        '<input type="hidden" value="'+id+'" name="user-id">'
                );
                passwordModal.modal('show');
            });
        });

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#alunos-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '{!! route('aluno.getAll') !!}'
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
                    {data: 'matricula', name: 'matricula', width: '10%'},
                    {data: 'nome', name: 'nome', width: '30%'},
                    {data: 'telefone', name: 'telefone', width: '10%'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'situacao'},
                    {data: 'action', name: 'action', width: '30%', orderable: false, searchable: false}
                ],
                createdRow: function ( row, data, index ) {
                    $('td', row).eq(5).addClass('text-center');
                }
            });
        });
    </script>
@endsection