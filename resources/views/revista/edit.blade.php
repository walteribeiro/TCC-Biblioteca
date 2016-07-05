@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-8 col-lg-offset-2 col-sm-12">Edição de Revista</h3>

    <form class="form-horizontal" action="{{ route('revista.update', $revista->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" autofocus value="{{ $revista->publicacao->titulo }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2">
                <label for="referencia">Referência</label>
                <input type="text" class="form-control" id="referencia" name="referencia"
                       placeholder="Referência"  value="{{ $revista->referencia }}">
            </div>
            <div class="col-lg-4">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria"
                       placeholder="Categoria" value="{{ $revista->categoria }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="descricao">Descricao</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descricao" value="{{ $revista->publicacao->descricao }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2">
                <label for="editora">Editora</label>
                <select class="form-control" name="editora" id="editora">
                    @foreach($listEditoras['editoras'] as $e)
                        @if($e->id == $revista->publicacao->editora->id)
                            <option value="{{ $e->id }}" selected>{{ $e->nome }}</option>
                        @else
                            <option value="{{ $e->id }}">{{ $e->nome }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-lg-4">
                <label for="edicao">Edicao</label>
                <input type="text" class="form-control" id="edicao" name="edicao"
                       placeholder="Edicao" value="{{ $revista->publicacao->edicao }}">
            </div>
        </div>
            <div class="col-lg-8 col-lg-offset-2 col-sm-6">
                <label for="origem">Origem</label>
                <input type="text" class="form-control" id="origem" name="origem"
                       placeholder="Origem" value="{{ $revista->publicacao->origem }}">
            </div>

        </div>
        <br><br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Salvar</button>
                <a href="{{ route('revista.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection