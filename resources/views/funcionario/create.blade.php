@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-8 col-lg-offset-2 col-sm-12">Cadastro de
        funcionario</h3>

    <form class="form-horizontal" action="{{ route('funcionario.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                <label for="nome">Nome do Funcionário</label>
                <input type="text" class="form-control" id="nome" name="nome"
                       placeholder="Nome do funcionario" autofocus value="{{ old('nome') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2 col-sm-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone"
                       placeholder="telefone do funcionario" value="{{ old('telefone') }}">
            </div>
            <div class="col-lg-4 col-sm-6">
                <label for="telefone2">Telefone 2</label>
                <input type="text" class="form-control" id="telefone2" name="telefone2"
                       placeholder="telefone do funcionario" value="{{ old('telefone') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2 col-sm-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                       placeholder="email do funcionario" value="{{ old('email') }}">
            </div>
            <div class="col-lg-4 col-sm-6">
                <label for="numRegistro">Registro</label>
                <input type="text" class="form-control" id="numeroRegistro" name="numeroRegistro"
                       placeholder="numero de registro" value="{{ old('numeroRegistro') }}">
            </div>
            </div>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2 col-sm-6">
                <label for="tipoFuncionario">Tipo de Funcionário</label>
                <select class="form-control" name="tipoFuncionario" id="tipoFuncionario">
                    <option value="0">Geral</option>
                    <option value="1">Professor</option>
                    <option value="2">Bibliotecário</option>
                </select>
            </div>
            <div class="col-lg-3 col-sm-6">
                <label for="usuario">Nome de Usuario</label>
                <input type="text" class="form-control" id="username" name="username"
                       placeholder="nome de usuario" value="{{ old('username') }}">
            </div>
            <div class="form-group">
                <div class="col-lg-3 col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="ativo" name="ativo" value="true" aria-label="situacao">Funcionário Ativo
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-2 col-sm-6">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha"
                       placeholder="senha do funcionario">
            </div>
            <div class="col-lg-4 col-sm-6">
                <label for="confirmarSenha">Confirmar Senha</label>
                <input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation"
                       placeholder="senha do funcionario">
            </div>
        </div>


        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-2">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('funcionario.index') }}" class="btn btn-default"><em class="fa fa-undo"></em>
                    Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection