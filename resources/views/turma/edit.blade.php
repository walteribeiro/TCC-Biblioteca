@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Edição de turma</h3>

    <form class="form-horizontal" action="{{ route('turma.update', $turma->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3 col-sm-12">
                <label for="serie">Série</label>
                <input type="text" class="form-control" id="serie" name="serie"
                       placeholder="Série" autofocus value="{{ $turma->serie }}">
            </div>

            <div class="col-lg-3 col-sm-12">
                <label for="turno">Turno</label>
                <input type="text" class="form-control" id="turno" name="turno"
                       placeholder="Turno" value="{{ $turma->turno }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-12">
                <label for="ano">Ano</label>
                <input type="number" class="form-control" id="ano" name="ano"
                       placeholder="Ano" value="{{ $turma->ano }}">
            </div>

            <div class="col-lg-2">
                <label for="ensino">Ensino</label>
                <input type="text" class="form-control" id="ensino" name="ensino"
                       placeholder="Ensino" value="{{ $turma->ensino }}">
            </div>

            <div class="col-lg-2">
                <label for="letraTurma">Letra</label>
                <input type="text" class="form-control" id="letraTurma" name="letraTurma"
                       placeholder="Letra" value="{{ $turma->letra_turma }}">
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
    <script>
        $(function () {
            $('#letraTurma').keypress(function (e) {
                var regex = new RegExp("^[a-zA-Z._\b]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });
        });
    </script>
@endsection