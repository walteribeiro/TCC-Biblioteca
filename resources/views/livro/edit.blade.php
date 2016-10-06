@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection
@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Edição de livro</h3>

    <form class="form-horizontal" action="{{ route('livro.update', $livro->publicacao->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" autofocus value="{{ $livro->publicacao->titulo }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="subtitulo">Subtitulo</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo"
                       placeholder="Subtitulo" value="{{ $livro->subtitulo }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descrição" value="{{ $livro->publicacao->descricao }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <label for="editora">Editora</label>
                <select class="form-control basic-select" name="editora" id="editora">
                    <option value="">Selecione uma editora</option>
                    @foreach($listAutoresEditoras['editoras'] as $e)
                        @if($e->id == $livro->publicacao->editora->id)
                            <option value="{{ $e->id }}" selected>{{ $e->nome }}</option>
                        @else
                            <option value="{{ $e->id }}">{{ $e->nome }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3">
                <label for="autor">Autor</label>
                <select class="form-control basic-select" name="autor" id="autor">
                    <option value="">Selecione um autor</option>
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
            <div class="col-lg-3 col-lg-offset-3 col-sm-6">
                <label for="edicao">Edição</label>
                <input type="text" class="form-control" id="edicao" name="edicao"
                       placeholder="Edição" value="{{ $livro->publicacao->edicao }}">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="origem">Origem</label>
                <input type="text" class="form-control" id="origem" name="origem"
                       placeholder="Origem" value="{{ $livro->publicacao->origem }}">
            </div>

            <div class="col-lg-1">
                <label for="ano">Ano</label>
                <input type="number" class="form-control" id="ano" name="ano"
                       placeholder="Ano" value="{{ $livro->ano }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3">
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

        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('livro.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/pt-BR.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".basic-select").select2();
        })
    </script>
@endsection