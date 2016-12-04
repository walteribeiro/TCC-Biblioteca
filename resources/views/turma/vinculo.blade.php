@extends('layout.main')

@section('header')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Vincular aluno</h3>

    <form class="form-horizontal" action="{{ route('turma.vincular') }}" method="post">

        {!! csrf_field() !!}

        <input type="hidden" name="id_turma" value="{{$turma->id}}">

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3">
                <label for="serie">Série</label>
                <input type="text" class="form-control" disabled id="serie" name="serie" value="{{$turma->serie}}">
            </div>

            <div class="col-lg-1">
                <label for="letra">Letra</label>
                <input type="text" class="form-control" disabled id="letra" name="letra" value="{{$turma->letra_turma}}">
            </div>

            <div class="col-lg-2">
                <label for="turno">Turno</label>
                <input type="text" class="form-control" disabled id="turno" name="turno"
                       value="@if($turma->turno == 0) Manhã @elseif($turma->turno == 1) Tarde @elseif($turma->turno == 2) Noite @endif">
            </div>

            <div class="col-lg-1">
                <label for="ano">Ano</label>
                <input type="text" class="form-control" disabled id="ano" name="ano" value="{{$turma->ano}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3">
                <label for="alunos">Alunos
                    <span class="required">*</span>
                </label>
                <select id="alunos" name="aluno[]" class="form-control" multiple="multiple" required autofocus>
                    @foreach($alunos as $a)
                        <option value="{{ $a->user_id }}">{{ $a->matricula . ' - ' . $a->user->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('turma.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/pt-BR.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#alunos').select2({
                placeholder: 'Selecione um ou mais alunos',
                escapeMarkup: function (markup) {
                    return markup;
                }
            });
        })
    </script>
@endsection