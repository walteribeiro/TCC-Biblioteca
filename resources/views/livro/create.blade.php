@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset("assets/css/switchery.min.css")}}">

    <style>
        span.switchery.switchery-small {
            vertical-align: bottom;
            margin-top: 27px;
        }
    </style>
@endsection
@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Cadastro de livro</h3>

    <form class="form-horizontal" action="{{ route('livro.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-3 col-sm-12">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" autofocus value="{{ old('titulo') }}">
            </div>

            <div class="col-lg-2 col-sm-2">
                <label>
                    <input type="checkbox" class="switch" value="true" name="status" id="status"/> Desativar livro
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="subtitulo">Subtitulo</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo"
                       placeholder="Subtitulo" value="{{ old('subtitulo') }}">
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
                <select class="js-states form-control basic-select" name="editora" id="editora">
                    @if(count($livros['editoras']) > 0)
                        <option value="" selected>Selecione uma editora</option>
                        @foreach($livros['editoras'] as $e)
                            <option value="{{ $e->id }}"
                                    @if ( old('editora') == $e->id) selected="selected" @endif>{{ $e->nome }}</option>
                        @endforeach
                    @else
                        <option value="" selected>Cadastre uma editora primeiro</option>
                    @endif
                </select>
            </div>

            <div class="col-lg-3">
                <label for="autor">Autor</label>
                <select class="js-states form-control basic-select" name="autor" id="autor">
                    @if(count($livros['autores']) > 0)
                        <option value="" selected>Selecione um autor</option>
                        @foreach($livros['autores'] as $a)
                            <option value="{{ $a->id }}"
                                    @if ( old('autor') == $a->id) selected="selected" @endif>{{ $a->nome." ".$a->sobrenome }}</option>
                        @endforeach
                    @else
                        <option value="" selected>Cadastre um autor primeiro</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-1 col-lg-offset-3 col-sm-6">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo"
                       placeholder="Código" value="{{ old('codigo') }}">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="edicao">Edição</label>
                <input type="text" class="form-control" id="edicao" name="edicao"
                       placeholder="Edição" value="{{ old('edicao') }}">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="origem">Origem</label>
                <input type="text" class="form-control" id="origem" name="origem"
                       placeholder="Origem" value="{{ old('origem') }}">
            </div>

            <div class="col-lg-1">
                <label for="ano">Ano</label>
                <input type="number" class="form-control" id="ano" name="ano"
                       placeholder="Ano" value="{{ old('ano') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3">
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
    <script src="{{ asset("assets/js/switchery.min.js")}}"></script>

    <script>
        $(document).ready(function () {
            $(".basic-select").select2();

            var elem = document.querySelector('.switch');
            var switchery = new Switchery(elem, {
                disabled: false,
                className: 'switchery',
                size: 'small',
                color: '#d9534f'
            });
        })
    </script>
@endsection