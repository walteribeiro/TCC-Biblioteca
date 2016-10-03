@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Alunos vinculados a turma
                        <strong>{{ $turma->serie . ' ' . $turma->letra_turma . ' - ' . $turma->ano }}</strong></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <a href="#modal" id="btn-remove" class="btn btn-danger disabled">
                            <em class="fa fa-trash-o"></em>
                            <span class="action-cnt"></span>
                        </a>
                        <a href="{{ route('turma.index') }}" class="btn btn-default pull-right"><em class="fa fa-undo"></em> Voltar</a>
                        <table id="alunos-vinculados" class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th data-orderable="false" data-toggle="buttons">
                                    <label class="btn btn-xs btn-success check" id="check-all">
                                        <input type="checkbox" autocomplete="off">
                                        <em class="fa fa-check"></em>
                                    </label>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($turma->alunos as $a)
                                <tr>
                                    <td>{{$a->user->id}}</td>
                                    <td>{{$a->user->nome}}</td>
                                    <td>{{$a->user->telefone}}</td>
                                    <td>{{$a->user->email}}</td>
                                    <td>@if($a->user->ativo == 1) Ativo @else Inativo @endif</td>
                                    <td class="a-center" data-toggle="buttons">
                                        <label class="btn btn-xs btn-success action check">
                                            <input type="checkbox" name="records" autocomplete="off" value="{{ $a->user->id }}">
                                            <em class="fa fa-check"></em>
                                        </label>
                                        {{--<input type="checkbox" class="bulk-action" name="table_records" value="{{ $a->user->id }}">--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('turma.delete')

@endsection
@section('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            var selected = [];
            var allChecked = false;

            var table = $('#alunos-vinculados').DataTable({
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

            $('label#check-all').on('click', function(){
                var list;
                var rows = table.rows({ 'page': 'current' }).nodes();

                if(!allChecked){
                    list = $('input[name="records"]', rows).attr('checked', true);
                    $('label.check', rows).addClass('active');

                    selected = [];
                    $.each(list, function(index, value){
                        var $vj = $(value);
                        selected.push($vj.val());
                    });
                    allChecked = true;
                }else{
                    list = $('input[name="records"]', rows).attr('checked', false);
                    $('label.check', rows).removeClass('active');

                    $.each(list, function(index, value){
                        var $vj = $(value);
                        selected.splice($vj, 1);
                    });
                    allChecked = false;
                }
                console.log(selected);
                countIds();
            });

            $("#alunos-vinculados tbody").on('change', 'input[name="records"]', function(){
                var obj = $(this);
                if(this.checked){
                    obj.attr("checked", true);
                    selected.push(obj.val());
                }else{
                    obj.attr("checked", true);
                    $.each(selected, function(idx, vl){
                        if(vl == obj.val()){
                            selected.splice(idx, 1);
                        }
                    });
                }

           /* $("label.action").click(function(){
                var inputCheck = $(this).find('input');
                if(!inputCheck.attr("checked")) {
                    inputCheck.attr("checked", true);
                    selected.push(inputCheck.val());
                } else {
                    inputCheck.attr("checked", false);
                    $.each(selected, function(idx, vl){
                       if(vl == inputCheck.val()){
                           selected.splice(idx, 1);
                       }
                    });
                }*/
                console.log(selected);
                countIds();
            });

            function countIds(){
                var checkCount = selected.length;
                console.log(checkCount);
                if (checkCount) {
                    $('#btn-remove').removeClass('disabled');
                    $('.action-cnt').html(checkCount + ' Registro(s)');
                } else {
                    $('#btn-remove').addClass('disabled');
                    $('.action-cnt').html('0 Registro(s)');
                }
            }

//            $('#alunos-vinculados tbody').on('ifChecked', 'input', function () {
//                var id = $(this).data('id');
//                selected.push( id );
//            });
//
//            $('#alunos-vinculados tbody').on('ifUnchecked', 'input', function () {
//                var id = $(this).data('id');
//                var index = $.inArray(id, selected);
//                selected.splice( index, 1 );
//            });

            var deleteLogModal = $('div#delete-modal');

            $("a[href='#modal']").click(function(event) {
                event.preventDefault();

                deleteLogModal.find('.modal-body p').html(
                        'Você tem certeza que deseja remover o(s) aluno(s) selecionados ?'
                );

                deleteLogModal.find('.modal-body input#alunos').val(selected);
                deleteLogModal.modal('show');
            });
        });
    </script>
@endsection