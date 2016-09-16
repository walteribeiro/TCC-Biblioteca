@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-6 col-lg-offset-3 col-sm-12">Cadastro de turma</h3>

    <form class="form-horizontal" action="{{ route('turma.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="serie">Série</label>
                <input type="text" class="form-control" id="serie" name="serie"
                       placeholder="Série" autofocus value="{{ old('serie') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="turno">Turno</label>
                <input type="text" class="form-control" id="turno" name="turno"
                       placeholder="Turno" value="{{ old('turno') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="ano">Ano</label>
                <input type="text" class="form-control" id="ano" name="ano"
                       placeholder="Ano" value="{{ old('ano') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <label for="ensino">Ensino</label>
                <input type="text" class="form-control" id="ensino" name="ensino"
                       placeholder="Ensino" value="{{ old('ensino') }}">

            </div>

            <div class="col-lg-3">
                <label for="letraTurma">Letra</label>
                <input type="text" class="form-control" id="letraTurma" name="letraTurma"
                       placeholder="Letra" value="{{ old('letraTurma') }}">

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