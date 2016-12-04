@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Alterar empréstimo</h3>

    <div class="row">
    <form class="form-horizontal" action="{{ route('emprestimo.update', $emprestimo->id) }}" method="post">

        {{method_field('put')}}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-12">
                <label for="data-prevista">Previsão de entrega
                    <span class="required">*</span>
                </label>
                <input type="date" class="form-control" id="data-prevista" name="data-prevista"
                       placeholder="Data prevista" autofocus value="{{date('Y-m-d', strtotime($emprestimo->data_prevista))}}"
                       min="{{\Carbon\Carbon::today()->format('Y-m-d')}}">
            </div>

            <div class="col-lg-4">
                <label for="usuario">Usuário</label>
                <input type="text" class="form-control" disabled value="{{$emprestimo->user->nome}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="publicacoes">Publicações</label>
                <ul class="list-unstyled timeline">
                    @foreach($emprestimo->publicacoes as $p)
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a class="tag">
                                        <span>{{ $emprestimo->data_emprestimo }}</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a>{{ $p->titulo }}</a>
                                    </h2>
                                    <p class="excerpt">{{ $p->descricao }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('emprestimo.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>
    </div>
@endsection