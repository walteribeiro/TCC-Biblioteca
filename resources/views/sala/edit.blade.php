@extends('layout.main')

@section('conteudo')

    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-6 col-lg-offset-3 col-sm-12">Edição de sala</h3>

    <form class="form-horizontal" action="{{ url('salas/atualizar', $sala->recurso->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-3 col-sm-12">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                       placeholder="Descrição da sala" autofocus value="{{ $sala->recurso->descricao }}">
            </div>

            <div class="col-lg-2 col-sm-12">
                <label for="tipo_sala">Tipo de sala</label>
                <select class="form-control" name="tipo_sala" id="tipo_sala">
                    @if($sala->tipo == 0)
                        <option value="0" selected>Vídeo</option>
                        <option value="1">Recreação</option>
                        <option value="2">Auditório</option>
                        <option value="3">Informática</option>
                    @elseif($sala->tipo == 1)
                        <option value="0">Vídeo</option>
                        <option value="1" selected>Recreação</option>
                        <option value="2">Auditório</option>
                        <option value="3">Informática</option>
                    @elseif($sala->tipo == 2)
                        <option value="0">Vídeo</option>
                        <option value="1">Recreação</option>
                        <option value="2" selected>Auditório</option>
                        <option value="3">Informática</option>
                    @elseif($sala->tipo == 3)
                        <option value="0">Vídeo</option>
                        <option value="1">Recreação</option>
                        <option value="2">Auditório</option>
                        <option value="3" selected>Informática</option>
                    @endif
                </select>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ url("salas") }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    @include('layout.includes.validate-request')
@endsection