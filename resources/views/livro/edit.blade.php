@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-8 col-lg-offset-2 col-sm-12">Edição de Livro</h3>

    <form class="form-horizontal" action="{{ route('livro.update', $livro->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" autofocus value="{{ $livro->publicacao->titulo }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="subtitulo">Subtitulo</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo"
                       placeholder="Subtitulo" value="{{ $livro->subtitulo }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="descricao">Descricao</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descricao" value="{{ $livro->publicacao->descricao }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2">
                <label for="editora">Editora</label>
                <select class="form-control" name="editora" id="editora">
                    @foreach($listAutoresEditoras['editoras'] as $e)
                        @if($e->id == $livro->publicacao->editora->id)
                            <option value="{{ $e->id }}" selected>{{ $e->nome }}</option>
                        @else
                            <option value="{{ $e->id }}">{{ $e->nome }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-lg-4">
                <label for="autor">Autor</label>
                <select class="form-control" name="autor" id="autor">
                    @foreach($listAutoresEditoras['autores'] as $a)
                        @if($a->id == $livro->autor->id)
                            <option value="{{ $a->id }}" selected>{{ $a->nome." ".$a->sobrenome }}</option>
                        @else
                            <option value="{{ $a->id }}">{{ $a->nome." ".$a->sobrenome }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-6">
                <label for="edicao">Edicao</label>
                <input type="text" class="form-control" id="edicao" name="edicao"
                       placeholder="Edicao" value="{{ $livro->publicacao->edicao }}">
            </div>

            <div class="col-lg-8 col-lg-offset-2 col-sm-6">
                <label for="origem">Origem</label>
                <input type="text" class="form-control" id="origem" name="origem"
                       placeholder="Origem" value="{{ $livro->publicacao->origem }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-2">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn"
                       placeholder="ISBN" value="{{ $livro->isbn }}">
            </div>

            <div class="col-lg-2">
                <label for="cdu">CDU</label>
                <input type="text" class="form-control" id="cdu" name="cdu"
                       placeholder="CDU" value="{{ $livro->cdu }}">
            </div>

            <div class="col-lg-2">
                <label for="cdd">CDD</label>
                <input type="text" class="form-control" id="cdd" name="cdd"
                       placeholder="CDD" value="{{ $livro->cdd }}">
            </div>

            <div class="col-lg-2">
                <label for="ano">Ano</label>
                <input type="text" class="form-control" id="ano" name="ano"
                       placeholder="Ano" value="{{ $livro->ano }}">
            </div>

        </div>
        <br><br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Salvar</button>
                <a href="{{ route('livro.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection