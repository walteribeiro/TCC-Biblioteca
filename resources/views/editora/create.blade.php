@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Cadastro de editora</h3>

    <form class="form-horizontal" action="{{ route('editora.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome"
                       placeholder="Nome da editora" autofocus value="{{ old('nome') }}">
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route("editora.index") }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>
@endsection