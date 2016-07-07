@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-8 col-lg-offset-2 col-sm-12">Edição de Autor</h3>

    <form class="form-horizontal" action="{{ route('autor.update', $autor->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="nome">Nome do Autor</label>
                <input type="text" class="form-control" id="nome" name="nome"
                       placeholder="Nome do Autor" autofocus value="{{ $autor->nome }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="sobrenome">Sobrenome do Autor</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome"
                       placeholder="Sobrenome do Autor" autofocus value="{{ $autor->sobrenome }}">
            </div>
        </div>
        <br><br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('autor.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection