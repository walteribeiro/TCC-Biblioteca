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

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Edição de aluno</h3>

    <form class="form-horizontal" action="{{ route('aluno.update', $aluno->user->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-3 col-sm-12">
                <label for="nome">Nome
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="nome" name="nome"
                       placeholder="Nome do aluno" autofocus value="{{ $aluno->user->nome }}">
            </div>

            <div class="col-lg-2 col-sm-2">
                <label>
                    @if($aluno->user->ativo == 1)
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
                       placeholder="Telefone" value="{{ $aluno->user->telefone }}" data-inputmask="'mask': '(99) 9999-9999'">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="telefone2">Celular</label>
                <input type="text" class="form-control" id="telefone2" name="telefone2"
                       placeholder="Celular" value="{{ $aluno->user->telefone2 }}" data-inputmask="'mask': '(99) 99999-9999'">
            </div>

            <div class="col-lg-2 col-sm-6">
                <label for="matricula">Matrícula
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="matricula" name="matricula"
                       placeholder="Matricula" value="{{ $aluno->matricula }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                       placeholder="Email" value="{{ $aluno->user->email }}">
            </div>
        </div>

        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('aluno.index') }}" class="btn btn-default"><em class="fa fa-undo"></em>
                    Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
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