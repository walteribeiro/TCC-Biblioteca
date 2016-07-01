@extends('layout.main')

@section('conteudo')

    <div class="col-md-8 col-md-offset-2">
        <h1 align="center">Editar Editora</h1>

        <form action="{{action('EditoraController@update', $e->id)}}" method="post">

            {{method_field("PUT")}}

            {!! csrf_field() !!}

            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="{{$e->nome}}">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Cadastrar">
            </div>
        </form>
    </div>

@endsection