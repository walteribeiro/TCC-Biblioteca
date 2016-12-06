@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Reservas
        <a href="{{ route('reserva.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

    @if(isset($reservas) && count($reservas) > 0)
        <table id="reservas" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Data Reserva</th>
                <th>Data Limite</th>
                <th>Situação</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservas as $e)
                <tr>
                    <td>{{$e->id}}</td>
                    <td>{{$e->user->nome}}</td>
                    <td>{{$e->data_reserva}}</td>
                    <td>{{date('d/m/Y', strtotime($e->data_limite))}}</td>
                    <td>
                        @if($e->situacao == 0)
                            <span class="label label-success">
                                Aberta
                            </span>
                        @else
                            <span class="label label-primary">
                                Fechada
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($e->situacao == 1)
                            <button class="btn btn-sm btn-primary" disabled>
                                <em class="fa fa-book"></em> Emprestar
                            </button>

                            <button class="btn btn-sm btn-success" disabled="">
                                <em class="fa fa-search"></em> Visualizar
                            </button>

                            <button class="btn btn-sm btn-warning" disabled>
                                <em class="fa fa-pencil"></em> Alterar
                            </button>

                            <button class="btn btn-sm btn-danger" disabled>
                                <em class="fa fa-trash-o"></em> Excluir
                            </button>
                        @else
                            <a href="#emprestar" class="btn btn-sm btn-primary"
                               data-id="{{ $e->id }}">
                                <em class="fa fa-book"></em> Emprestar
                            </a>

                            <a href="#show" class="btn btn-sm btn-success"
                               data-situacao="{{ $e->situacao}}"
                               data-data_reserva="{{ $e->data_reserva}}"
                               data-data_limite="{{ $e->data_limite}}"
                               data-usuario="{{ $e->user->nome}}"
                               data-publicacao="{{ $e->publicacoes }}">
                                <em class="fa fa-search"></em> Visualizar
                            </a>

                            <a href="{{ route('reserva.edit', $e->id)}}" class="btn btn-sm btn-warning">
                                <em class="fa fa-pencil"></em> Alterar
                            </a>

                            <a href="#modal" class="btn btn-sm btn-danger"
                               data-delete="{{ $e->data_reserva }}"
                               data-id="{{ $e->id }}">
                                <em class="fa fa-trash-o"></em> Excluir
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram efetuadas reservas!</h5>
    @endif

    @include('layout.delete-modal')

    @include('layout.show-modal')

    <div class="modal fade" id="reservar-modal" role="dialog" data-backdrop="static">
        <form action="" id="formreservar" method="post">
            {{ method_field('put') }}
            {!! csrf_field() !!}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Reserva</h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <em class="fa fa-undo"></em> Voltar
                        </button>
                        <button type="submit" class="btn btn-dark">
                            <em class="fa fa-ban"></em> Emprestar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
                var data = $(this).data('delete');

                deleteLogModal.find('.modal-body p').html(
                        'Você tem certeza que deseja excluir a reserva do dia ' + data + ' ?'
                );

                $('#formexcluir').attr("action", "reservas/remover/"+id);
                deleteLogModal.modal('show');
            });
        });

        $(function (){
            var showModal = $('div#show-modal');

            $("a[href='#show']").click(function(event) {
                event.preventDefault();
                var situacao = $(this).data('situacao');
                var data_reserva = $(this).data('data_reserva');
                var data_limite = moment($(this).data('data_limite'), 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
                var usuario = $(this).data('usuario');
                var publicacao = $(this).data('publicacao');

                showModal.find('.modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-3">Usuário:</div>' +
                        '<div class="col-md-9"><p>'+ usuario + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-3">Data reserva:</div>' +
                        '<div class="col-md-9"><p>'+ data_reserva + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-3">Data limite:</div>' +
                        '<div class="col-md-9"><p>'+ data_limite + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-3">Situação:</div>' +
                        '<div class="col-md-9"><p>'+ (situacao == 0 ? "Aberta" : "Fechada") + '</p></div>' +
                        '</div>'+
                        '<div class="row">' +
                        '<div class="col-md-3">Publicação:</div>' +
                        '<div class="col-md-9"><p>'+ publicacao[0].codigo + ' - ' + publicacao[0].titulo + '</p></div>' +
                        '</div>'
                );

                showModal.modal('show');
            });
        });

        $(function () {
            var reservarModal = $('div#reservar-modal');

            $("a[href='#emprestar']").click(function(event) {
                event.preventDefault();
                var id = $(this).data('id');

                reservarModal.find('.modal-body p').html(
                        'Você tem certeza que deseja efetuar o empréstimo para esta reserva ?'
                );

                $('#formreservar').attr("action", "reservas/emprestar/"+id);
                reservarModal.modal('show');
            });
        });

        $(function () {
            $('#reservas').DataTable({
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