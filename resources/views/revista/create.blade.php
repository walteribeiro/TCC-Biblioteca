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

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Cadastro de revista</h3>

    <form class="form-horizontal" action="{{ route('revista.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-3 col-sm-12">
                <label for="titulo">Titulo
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Titulo" value="{{ old('titulo') }}" autofocus>
            </div>
            <div class="col-lg-2 col-sm-2">
                <label>
                    <input type="checkbox" class="switch" value="true" name="status" id="status"/> Desativar revista
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-1 col-lg-offset-3">
                <label for="codigo">Código
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="codigo" name="codigo"
                       placeholder="Código" value="{{ old('codigo') }}">
            </div>

            <div class="col-lg-1">
                <label for="referencia">Referência
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="referencia" name="referencia"
                       placeholder="Referência" value="{{ old('referencia') }}" data-inputmask="'mask': '99/9999'">
            </div>

            <div class="col-lg-2">
                <label for="categoria">Categoria
                    <span class="required">*</span>
                </label>
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
                <label for="editora">Editora
                    <span class="required">*</span>
                </label>
                <select class="js-states form-control basic-select" name="editora" id="editora">
                    @if(count($revistas['editoras']) > 0)
                        <option value="" selected>Selecione uma editora</option>
                        @foreach($revistas['editoras'] as $e)
                            <option value="{{ $e->id }}"
                                    @if ( old('editora') == $e->id) selected="selected" @endif>{{ $e->nome }}</option>
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
@section('scripts')
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/pt-BR.js')}}"></script>
    <script src="{{ asset("assets/js/switchery.min.js")}}"></script>
    <script src="{{ asset("assets/js/jquery.inputmask.bundle.min.js")}}"></script>
    <script>
        $(document).ready(function () {
            $(".basic-select").select2();
            $(":input").inputmask();

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