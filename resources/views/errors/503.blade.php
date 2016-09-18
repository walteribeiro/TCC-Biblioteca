@extends('layout.main')

@section('conteudo')
    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">503</h1>
                <h2>Erro interno</h2>
                <p>Favor entrar em contato com o administrador.</p>
                <div class="mid_center">
                    <a href="{{ route('home.index') }}" class="btn btn-dark btn-lg btn-block"><em class="fa fa-undo"></em> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection