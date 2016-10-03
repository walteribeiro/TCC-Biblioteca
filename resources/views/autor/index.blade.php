@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Autores
        <a href="{{ route('autor.create') }}" class="btn btn-primary pull-right">
            <em class="fa fa-plus"></em> Novo
        </a>
    </h3>

    @if(isset($autores) && count($autores) > 0)
        <table id="autores" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($autores as $a)
                <tr>
                    <td>{{$a->id}}</td>
                    <td>{{$a->nome}}</td>
                    <td>{{$a->sobrenome}}</td>
                    <td class="text-center">
                        <a href="#show" class="btn btn-sm btn-success"
                           data-nome="{{ $a->nome }}"
                           data-sobrenome="{{ $a->sobrenome }}">
                            <em class="fa fa-search"></em> Visualizar
                        </a>
                        <a href="{{ route('autor.edit', $a->id)}}" class="btn btn-sm btn-warning">
                            <em class="fa fa-pencil"></em> Alterar
                        </a>
                        <a href="#modal" class="btn btn-sm btn-danger"
                           data-delete="{{ $a->nome }}"
                           data-id="{{ $a->id }}">
                            <em class="fa fa-trash-o"></em> Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastrados autores!</h5>
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
                        'Você tem certeza que deseja excluir o autor ' + nome.toUpperCase() + ' ?'
                );

                $('#formexcluir').attr("action", "autores/remover/"+id);
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
                        'Nome: ' + nome + ' ' + sobrenome
                );

                showModal.modal('show');
            });
        });

        $(function () {
            $('#autores').DataTable({
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