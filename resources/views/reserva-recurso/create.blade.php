@extends('layout.main')
@section('header')

    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

@endsection
@section('conteudo')


    <h3 style="border-bottom:2px solid silver;margin-bottom:10px" class="col-lg-6 col-lg-offset-3 col-sm-12">Reservar
        Recurso</h3>

    <form class="form-horizontal" action="{{ url('reserva-recurso/gravar') }}" method="post">

        {!! csrf_field() !!}


        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="recurso">Selecione o professor</label>
                <select class="js-states form-control js-example-basic-multiple" name="funcionario" id="funcionario">
                    <optgroup label="Professor">
                    @if(count($reservaRecurso['funcionarios']) > 0)
                        @foreach($reservaRecurso['funcionarios'] as $r)
                            <option value="{{ $r->id }}">{{ $r->user->nome }}</option>
                        @endforeach
                    @else
                        <option value="" selected>Cadastre um Funcionário Primeiro</option>
                    @endif
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="recurso">Selecione o recurso</label>
              <select class="js-states form-control js-example-basic-multiple" name="recurso" id="recurso">
                    <optgroup label="Recursos">
                        @if(count($reservaRecurso['recursos']) > 0)
                            @foreach($reservaRecurso['recursos'] as $r)
                                <option value="{{ $r->id }}">{{ $r->descricao }}</option>
                            @endforeach
                        @else
                            <option value="" selected>Cadastre um Recurso Primeiro</option>
                        @endif
                    </optgroup>
                </select>
            </div>
        </div>


        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="dataReserva">Selecione a data da reserva</label>
            </div>
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <input class="form-control date" type="date" id="data_reserva" name="data_reserva">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="recurso">Selecione o horário</label>
                <select class="js-states form-control js-example-basic-multiple" name="aula[]" id="aula">
                    <optgroup label="Manhã">
                        <option value="1">1 M</option>
                        <option value="2">2 M</option>
                        <option value="3">3 M</option>
                        <option value="4">4 M</option>
                        <option value="5">5 M</option>
                    </optgroup>

                    <optgroup label="Tarde">
                        <option value="6">1 T</option>
                        <option value="7">2 T</option>
                        <option value="8">3 T</option>
                        <option value="9">4 T</option>
                        <option value="10">5 T</option>
                    </optgroup>

                    <optgroup label="Noite">
                        <option value="11">1 N</option>
                        <option value="12">2 N</option>
                        <option value="13">3 N</option>
                        <option value="14">4 N</option>
                        <option value="15">5 N</option>
                    </optgroup>

                </select>
            </div>
        </div>

        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ url("reserva-recurso") }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    @include('layout.includes.validate-request')

    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/pt-BR.js')}}"></script>
    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>

@endsection