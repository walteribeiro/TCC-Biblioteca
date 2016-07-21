@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-8 col-lg-offset-2 col-sm-12">Cadastro de
        funcionario</h3>

    <form class="form-horizontal" action="{{ route('funcionario.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="nome">Nome do funcionario</label>
                <input type="text" class="form-control" id="nome" name="nome"
                       placeholder="Nome do funcionario" autofocus value="{{ old('nome') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="sobrenome">Sobrenome do funcionario</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome"
                       placeholder="Sobrenome do funcionario" value="{{ old('sobrenome') }}">
            </div>
        </div>
        <br><br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('funcionario.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection