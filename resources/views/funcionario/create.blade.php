@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{ asset("assets/css/switchery.min.css")}}">

    <style>
        span.switchery.switchery-small {
            vertical-align: bottom;
            margin-top: 27px;
        }
    </style>
@endsection
@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Cadastro de funcionário</h3>

    <form class="form-horizontal" action="{{ route('funcionario.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-3 col-sm-12">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome"
                       placeholder="Nome do funcionário" autofocus value="{{ old('nome') }}">
            </div>

            <div class="col-lg-2 col-sm-2">
                <label>
                    <input type="checkbox" class="switch" checked value="true" name="ativo" id="ativo"/> Ativo
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone"
                       placeholder="Telefone" value="{{ old('telefone') }}" data-inputmask="'mask': '(99) 9999-9999'">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="telefone2">Celular</label>
                <input type="text" class="form-control" id="telefone2" name="telefone2"
                       placeholder="Celular" value="{{ old('telefone2') }}" data-inputmask="'mask': '(99) 99999-9999'">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="numRegistro">Nº registro</label>
                <input type="text" class="form-control" id="numeroRegistro" name="numeroRegistro"
                       placeholder="Nº registro" value="{{ old('numeroRegistro') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-3 col-sm-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                       placeholder="Email" value="{{ old('email') }}">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="tipoFuncionario">Tipo de funcionário</label>
                <select class="form-control" name="tipoFuncionario" id="tipoFuncionario">
                    <option value="0">Geral</option>
                    <option value="1">Professor</option>
                    <option value="2">Bibliotecário</option>
                </select>
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<div class="col-lg-2 col-lg-offset-3 col-sm-6">--}}
                {{--<label for="usuario">Nome de usuário</label>--}}
                {{--<input type="text" class="form-control" id="username" name="username"--}}
                       {{--placeholder="Nome de usuário" value="{{ old('username') }}">--}}
            {{--</div>--}}

            {{--<div class="col-lg-2 col-sm-6">--}}
                {{--<label for="senha">Senha</label>--}}
                {{--<input type="password" class="form-control" id="senha" name="senha"--}}
                       {{--placeholder="Senha">--}}
            {{--</div>--}}

            {{--<div class="col-lg-2 col-sm-6">--}}
                {{--<label for="confirmarSenha">Confirmar senha</label>--}}
                {{--<input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation"--}}
                       {{--placeholder="Confirmar senha">--}}
            {{--</div>--}}
        {{--</div>--}}
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('funcionario.index') }}" class="btn btn-default"><em class="fa fa-undo"></em>
                    Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="{{ asset("assets/js/switchery.min.js")}}"></script>
    <script src="{{ asset("assets/js/jquery.inputmask.bundle.min.js")}}"></script>
    <script>
        $(function () {

            $(":input").inputmask();

            var elem = document.querySelector('.switch');
            var switchery = new Switchery(elem, {
                disabled: false,
                className: 'switchery',
                size: 'small',
                color: '#26B99A'
            });
        });
    </script>
@endsection