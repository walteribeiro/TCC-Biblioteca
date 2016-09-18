@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Cadastro de data show</h3>

    <form class="form-horizontal" action="{{ route('data-show.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descrição do data show" autofocus value="{{ old('descricao') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-3 col-sm-12">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca"
                       placeholder="Marca" value="{{ old('marca') }}">
            </div>

            <div class="col-lg-2 col-sm-12">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo"
                       placeholder="Código" value="{{ old('codigo') }}">
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route("data-show.index") }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>
@endsection