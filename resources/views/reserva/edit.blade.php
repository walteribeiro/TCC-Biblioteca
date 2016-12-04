@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Alterar reserva</h3>

    <div class="row">
    <form class="form-horizontal" action="{{ route('reserva.update', $reserva->id) }}" method="post">

        {{method_field('put')}}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-12">
                <label for="data-limite">Data limite para buscar
                    <span class="required">*</span>
                </label>
                <input type="date" class="form-control" id="data-limite" name="data-limite"
                       placeholder="Data limite para buscar" autofocus value="{{date('Y-m-d', strtotime($reserva->data_limite))}}"
                       min="{{\Carbon\Carbon::today()->format('Y-m-d')}}">
            </div>

            <div class="col-lg-4">
                <label for="usuario">Usuário</label>
                <input type="text" class="form-control" disabled value="{{$reserva->user->nome}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="publicacoes">Publicações</label>
                <ul class="list-unstyled timeline">
                    @foreach($reserva->publicacoes as $p)
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a class="tag">
                                        <span>{{ $reserva->data_reserva }}</span>
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
                <a href="{{ route('reserva.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>
    </div>
@endsection