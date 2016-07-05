@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="page-header">Revistas <a href="{{ route('revista.create') }}" class="btn btn-primary pull-right">Novo</a></h3>

    @if(isset($revistas) && count($revistas) > 0)
        <table id="revistas" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Edição</th>
                <th>Categoria</th>
                <th data-orderable="false">Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($revistas as $l)
                <tr>
                    <td>{{$l->publicacao->id}}</td>
                    <td>{{$l->publicacao->titulo}}</td>
                    <td>{{$l->publicacao->edicao}}</td>
                    <td>{{$l->categoria}}</td>
                    <td class="text-center">
                        <a href="{{ route('revista.edit', $l->publicacao->id)}}" class="btn btn-sm btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#" class="btn btn-sm btn-danger" onclick="abrirModal({{$l->publicacao->id}})">
                            <span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="alert alert-info">Ainda não foram cadastradas revistas!</h5>
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
            $('#formexcluir').attr("action", "revistas/remover/"+id);
            $('#exclusao').modal()
        }

        $(document).ready(function () {
            $('#revistas').DataTable({
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