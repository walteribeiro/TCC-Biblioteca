@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-8 col-lg-offset-2 col-sm-12">Cadastro de Livros</h3>

    <form class="form-horizontal" action="{{ route('livro.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" autofocus value="{{ old('titulo') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="subtitulo">Subtitulo</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo"
                       placeholder="Subtitulo" value="{{ old('subtitulo') }}">
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
                    @foreach($livros['editoras'] as $e)
                        <option value="{{ $e->id }}">{{ $e->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-4">
                <label for="autor">Autor</label>
                <select class="form-control" name="autor" id="autor">
                    @foreach($livros['autores'] as $a)
                        <option value="{{ $a->id }}">{{ $a->nome." ".$a->sobrenome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-6">
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

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-2">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn"
                       placeholder="ISBN" value="{{ old('isbn') }}">
            </div>

            <div class="col-lg-2">
                <label for="cdu">CDU</label>
                <input type="text" class="form-control" id="cdu" name="cdu"
                       placeholder="CDU" value="{{ old('cdu') }}">
            </div>

            <div class="col-lg-2">
                <label for="cdd">CDD</label>
                <input type="text" class="form-control" id="cdd" name="cdd"
                       placeholder="CDD" value="{{ old('cdd') }}">
            </div>

            <div class="col-lg-2">
                <label for="ano">Ano</label>
                <input type="text" class="form-control" id="ano" name="ano"
                       placeholder="Ano" value="{{ old('ano') }}">
            </div>

        </div>
        <br><br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('livro.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')

    <script src="{{ asset('assets/js/jquery.inputmask.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#ano').inputmask("99-9999999");
        })
    </script>
@endsection