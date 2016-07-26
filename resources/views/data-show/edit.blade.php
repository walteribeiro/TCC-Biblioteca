@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-8 col-lg-offset-2 col-sm-12">Edição de Data Show</h3>

    <form class="form-horizontal" action="{{ url('data-shows/atualizar', $recurso->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descrição do Data Show" autofocus value="{{ $recurso->descricao }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-2 col-sm-12">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca"
                       placeholder="Marca" value="{{ $recurso->dataShow->marca }}">
            </div>

            <div class="col-lg-3  col-sm-12">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo"
                       placeholder="Código" value="{{ $recurso->dataShow->codigo }}">
            </div>
        </div>
        <br><br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ url("data-shows") }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection