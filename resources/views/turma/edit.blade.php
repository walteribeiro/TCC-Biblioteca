@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-6 col-lg-offset-3 col-sm-12">Edição de turma</h3>

    <form class="form-horizontal" action="{{ route('turma.update', $turma->publicacao->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" autofocus value="{{ $turma->publicacao->titulo }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="subtitulo">Subtitulo</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo"
                       placeholder="Subtitulo" value="{{ $turma->subtitulo }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descrição" value="{{ $turma->publicacao->descricao }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <label for="editora">Editora</label>
                <select class="form-control" name="editora" id="editora">
                    @foreach($listAutoresEditoras['editoras'] as $e)
                        @if($e->id == $turma->publicacao->editora->id)
                            <option value="{{ $e->id }}" selected>{{ $e->nome }}</option>
                        @else
                            <option value="{{ $e->id }}">{{ $e->nome }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3">
                <label for="autor">Autor</label>
                <select class="form-control" name="autor" id="autor">
                    @foreach($listAutoresEditoras['autores'] as $a)
                        @if($a->id == $turma->autor->id)
                            <option value="{{ $a->id }}" selected>{{ $a->nome." ".$a->sobrenome }}</option>
                        @else
                            <option value="{{ $a->id }}">{{ $a->nome." ".$a->sobrenome }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3 col-sm-6">
                <label for="edicao">Edição</label>
                <input type="text" class="form-control" id="edicao" name="edicao"
                       placeholder="Edição" value="{{ $turma->publicacao->edicao }}">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="origem">Origem</label>
                <input type="text" class="form-control" id="origem" name="origem"
                       placeholder="Origem" value="{{ $turma->publicacao->origem }}">
            </div>

            <div class="col-lg-1">
                <label for="ano">Ano</label>
                <input type="text" class="form-control" id="ano" name="ano"
                       placeholder="Ano" value="{{ $turma->ano }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn"
                       placeholder="ISBN" value="{{ $turma->isbn }}">
            </div>

            <div class="col-lg-2">
                <label for="cdu">CDU</label>
                <input type="text" class="form-control" id="cdu" name="cdu"
                       placeholder="CDU" value="{{ $turma->cdu }}">
            </div>

            <div class="col-lg-2">
                <label for="cdd">CDD</label>
                <input type="text" class="form-control" id="cdd" name="cdd"
                       placeholder="CDD" value="{{ $turma->cdd }}">
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