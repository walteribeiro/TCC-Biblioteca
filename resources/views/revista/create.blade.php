@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Cadastro de revista</h3>

    <form class="form-horizontal" action="{{ route('revista.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" value="{{ old('titulo') }}" autofocus>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-1 col-lg-offset-3">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo"
                       placeholder="Código" value="{{ old('codigo') }}">
            </div>

            <div class="col-lg-1">
                <label for="referencia">Referência</label>
                <input type="text" class="form-control" id="referencia" name="referencia"
                       placeholder="Referência" value="{{ old('referencia') }}">
            </div>

            <div class="col-lg-2">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria"
                       placeholder="Categoria" value="{{ old('categoria') }}">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="origem">Origem</label>
                <input type="text" class="form-control" id="origem" name="origem"
                       placeholder="Origem" value="{{ old('origem') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descrição" value="{{ old('descricao') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <label for="editora">Editora</label>
                <select class="form-control" name="editora" id="editora">
                    @if(count($revistas['editoras']) > 0)
                        @foreach($revistas['editoras'] as $e)
                            <option value="{{ $e->id }}">{{ $e->nome }}</option>
                        @endforeach
                    @else
                        <option value="" selected>Cadastre uma editora primeiro</option>
                    @endif
                </select>
            </div>

            <div class="col-lg-3">
                <label for="edicao">Edição</label>
                <input type="text" class="form-control" id="edicao" name="edicao"
                       placeholder="Edição" value="{{ old('edicao') }}">
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('revista.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection