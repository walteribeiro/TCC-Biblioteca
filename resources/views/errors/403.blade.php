@extends('layout.main')

@section('conteudo')
    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">403</h1>
                <h2>Acesso Negado</h2>
                <p>Você não possui permissão para acessar esta página.</p>
                <div class="mid_center">
                    <a href="{{ route('home.index') }}" class="btn btn-dark btn-lg btn-block"><em class="fa fa-undo"></em> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection