@extends('layout.main')

@section('conteudo')

    <div class="col-md-8 col-md-offset-2">

        <h1 align="center">Cadastro de Editoras</h1>

        <form action="{{action('EditoraController@store')}}" method="post">

            {!! csrf_field() !!}

            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Cadastrar">
            </div>
        </form>
    </div>

@endsection
