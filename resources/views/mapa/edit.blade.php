@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Edição de mapa</h3>

    <form class="form-horizontal" action="{{ route('mapa.update', $mapa->recurso->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="descricao">Descrição
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descrição do mapa" autofocus value="{{ $mapa->recurso->descricao }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-3 col-sm-12">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Título" value="{{ $mapa->titulo }}">
            </div>

            <div class="col-lg-2  col-sm-12">
                <label for="numero">Número
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="numero" name="numero" data-inputmask="'mask': '999'"
                       placeholder="Número" value="{{ $mapa->numero }}">
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route("mapa.index") }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="{{ asset("assets/js/jquery.inputmask.bundle.min.js")}}"></script>
    <script>
        $(document).ready(function () {
            $(":input").inputmask();
        })
    </script>
@endsection