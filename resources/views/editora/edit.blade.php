@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-10 col-lg-offset-1 col-sm-12">Edição de Editora</h3>

    <form class="form-horizontal" action="{{ url('editoras/atualizar', $editora->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-1 col-sm-12">
                <label for="nome">Nome da Editora</label>
                <input type="text" class="form-control" id="nome" name="nome"
                       placeholder="Nome da Editora" autofocus value="{{ $editora->nome }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-1">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Salvar</button>
                <a href="{{ url("editoras") }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection