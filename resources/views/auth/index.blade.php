@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Autores <a href="{{ route('registro.create') }}" class="btn btn-primary pull-right">Novo</a></h3>

    @if(isset($usuarios) && count($usuarios) > 0)
        <table id="usuarios" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Usuario</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $u)
                <tr>
                    <td>{{$u->id}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->username}}</td>
                    <td class="text-center">
                        <a href="{{ route('registro.edit', $u->id)}}" class="btn btn-sm btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#" class="btn btn-sm btn-danger" onclick="abrirModal({{$u->id}})">
                            <span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastrados usuários!</h5>
        @endif

                <!-- Modal Exclusão -->
        <div class="modal fade" id="exclusao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <h4>Deseja excluir o registro ?</h4>
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
        function abrirModal(id){
            $('#formexcluir').attr("action", "autores/remover/"+id);
            $('#exclusao').modal()
        }

        $(document).ready(function () {
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