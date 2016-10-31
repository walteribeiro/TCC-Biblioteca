@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection
@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Efetuar reserva</h3>

    <div class="row">
    <form class="form-horizontal" action="{{ route('reserva.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-12">
                <label for="data-limite">Data limite para buscar</label>
                <input type="date" class="form-control" id="data-limite" name="data-limite"
                       placeholder="Data limite" autofocus value="{{$data_limite}}">
            </div>

            <div class="col-lg-4">
                <label for="usuario">Usuário</label>
                <select class="js-states form-control basic-select" name="usuario" id="usuario">
                    @if(count($usuarios) > 0)
                        <option value="" selected>Selecione um usuário</option>
                        @foreach($usuarios as $u)
                            <option value="{{ $u->id }}" @if( old('usuario') == $u->id) selected="selected" @endif >{{ $u->nome }}</option>
                        @endforeach
                    @else
                        <option value="" selected>Cadastre um usuário primeiro</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="publicacao">Publicação</label>
                <div class="divider"></div>
                <select class="js-states form-control basic-select" required id="publicacao" name="publicacao">
                    @if(count($publicacoes) > 0)
                        <option value="" selected>Selecione uma publicacao</option>
                        @foreach($publicacoes as $p)
                            <option value="{{ $p->id }}"  @if( old('publicacao') == $p->id) selected="selected" @endif>{{ $p->codigo . ' - ' . $p->titulo }}</option>
                        @endforeach
                    @else
                        <option value="" selected>Cadastre uma publicacao primeiro</option>
                    @endif
                </select>
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
@section('scripts')
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/pt-BR.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".basic-select").select2();
        })
    </script>
@endsection