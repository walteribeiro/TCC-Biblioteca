@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-8 col-lg-offset-2 col-sm-12">Cadastro de Revistas</h3>

    <form class="form-horizontal" action="{{ route('revista.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" value="{{ old('titulo') }}" autofocus>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2">
                <label for="referencia">Referência</label>
                <input type="text" class="form-control" id="referencia" name="referencia"
                       placeholder="Referência" value="{{ old('referencia') }}">
            </div>
            <div class="col-lg-4">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria"
                       placeholder="Categoria" value="{{ old('categoria') }}">
            </div>

        </div>

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="descricao">Descricao</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descricao" value="{{ old('descricao') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2">
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
                <div class="col-lg-4">
                    <label for="edicao">Edicao</label>
                    <input type="text" class="form-control" id="edicao" name="edicao"
                           placeholder="Edicao" value="{{ old('edicao') }}">
                </div>
            </div>

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-6">
                <label for="origem">Origem</label>
                <input type="text" class="form-control" id="origem" name="origem"
                       placeholder="Origem" value="{{ old('origem') }}">
            </div>
        </div>

        <br><br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('revista.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection