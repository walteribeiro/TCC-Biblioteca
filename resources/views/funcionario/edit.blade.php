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

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-6 col-lg-offset-3 col-sm-12">Edição de funcionário</h3>

    <form class="form-horizontal" action="{{ route('funcionario.update', $funcionario->user->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-3 col-sm-12">
                <label for="nome">Nome do funcionário</label>
                <input type="text" class="form-control" id="nome" name="nome"
                       placeholder="Nome do funcionário" autofocus value="{{ $funcionario->user->nome }}">
            </div>

            <div class="col-lg-2 col-sm-2">
                <label>
                    @if($funcionario->user->ativo == 1)
                        <input type="checkbox" class="switch" checked value="true" name="ativo" id="ativo"/> Ativo
                    @else
                        <input type="checkbox" class="switch" value="false" name="ativo" id="ativo"/> Ativo
                    @endif
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone"
                       placeholder="Telefone" value="{{ $funcionario->user->telefone }}" data-inputmask="'mask': '(99) 9999-9999'">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="telefone2">Telefone 2</label>
                <input type="text" class="form-control" id="telefone2" name="telefone2"
                       placeholder="Telefone 2" value="{{ $funcionario->user->telefone2 }}" data-inputmask="'mask': '(99) 99999-9999'">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="numRegistro">Nº registro</label>
                <input type="text" class="form-control" id="numeroRegistro" name="numeroRegistro"
                       placeholder="Nº registro" value="{{ $funcionario->num_registro }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-3 col-sm-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                       placeholder="Email" value="{{ $funcionario->user->email }}">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="tipoFuncionario">Tipo de Funcionário</label>
                <select class="form-control" name="tipoFuncionario" id="tipoFuncionario">
                    @if($funcionario->tipo_funcionario == 0)
                        <option value="0" selected>Geral</option>
                        <option value="1">Professor</option>
                        <option value="2">Bibliotecário</option>
                    @elseif($funcionario->tipo_funcionario == 1)
                        <option value="0">Geral</option>
                        <option value="1" selected>Professor</option>
                        <option value="2">Bibliotecário</option>
                    @elseif($funcionario->tipo_funcionario == 2)
                        <option value="0">Geral</option>
                        <option value="1">Professor</option>
                        <option value="2" selected>Bibliotecário</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-6">
                <label for="usuario">Nome de usuário</label>
                <input type="text" class="form-control" id="username" name="username"
                       placeholder="Nome de usuário" value="{{ $funcionario->user->username }}">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha"
                       placeholder="Senha">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="confirmarSenha">Confirmar Senha</label>
                <input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation"
                       placeholder="Confirma senha">
            </div>
        </div>

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
    @include('layout.includes.validate-request')
    <script src="{{ asset("assets/js/switchery.min.js")}}"></script>
    <script src="{{ asset("assets/js/jquery.inputmask.bundle.min.js")}}"></script>
    <script>
        $(document).ready(function () {

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