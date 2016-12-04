@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Cadastro de sala</h3>

    <form class="form-horizontal" action="{{ route('sala.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-3 col-sm-12">
                <label for="descricao">Descrição
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descrição da sala" autofocus value="{{ old('descricao') }}">
            </div>

            <div class="col-lg-2 col-sm-12">
                <label for="tipo_sala">Tipo de sala</label>
                <select class="form-control" name="tipo_sala" id="tipo_sala">
                    <option value="0">Vídeo</option>
                    <option value="1">Recreação</option>
                    <option value="2">Auditório</option>
                    <option value="3">Informática</option>
                </select>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route("sala.index") }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection