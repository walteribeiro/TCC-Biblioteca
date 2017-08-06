@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection
@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Efetuar empréstimo</h3>

    <div class="row">
    <form class="form-horizontal" action="{{ route('emprestimo.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-4">
                <label for="data-prevista">Previsão de entrega
                    <span class="required">*</span>
                </label>
                <input type="date" class="form-control" id="data-prevista" name="data-prevista"
                       placeholder="Data prevista" autofocus value="{{$data_prevista}}" min="{{\Carbon\Carbon::today()->format('Y-m-d')}}">
            </div>

            <div class="col-lg-4 col-sm-8">
                <label for="usuario">Usuário
                    <span class="required">*</span>
                </label>
                <select class="js-states form-control basic-select" name="usuario" id="usuario">
                    @if(count($usuarios) > 0)
                        <option value="" selected>Selecione um usuário</option>
                        @foreach($usuarios as $u)
                            <option data-acesso="{{ $u->tipo_pessoa }}" value="{{ $u->id }}" @if( old('usuario') == $u->id) selected="selected" @endif >{{ $u->nome }}</option>
                        @endforeach
                    @else
                        <option value="" selected>Cadastre um usuário primeiro</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <label for="publicacoes">Publicações
                    <span class="required">*</span>
                </label>
                <div class="divider"></div>
                <select id="publicacoes" name="publicacoes[]" disabled class="form-control" multiple="multiple">
                    @foreach($publicacoes as $p)
                        <option value="{{ $p->id }}">{{ $p->codigo . ' - ' . $p->titulo }}</option>
                    @endforeach
                </select>
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
@section('scripts')
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/pt-BR.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".basic-select").select2();
            var publicacoes = $('#publicacoes').select2({
                placeholder: 'Selecione uma ou mais publicações',
                maximumSelectionLength: 2,
                escapeMarkup: function (markup) {
                    return markup;
                }
            });

            $(".basic-select").on("select2:select", function (e) {
                var x = $('option:selected').data('acesso');
                if(x == 3){
                    publicacoes.prop("disabled", false);
                    $('#publicacoes').select2({maximumSelectionLength: 2});
                    $("#publicacoes").select2('val', 'All');
                }else if(x == 2 || x == 1 || x == 0){
                    publicacoes.prop("disabled", false);
                    $('#publicacoes').select2({maximumSelectionLength: 1});
                    $("#publicacoes").select2('val', 'All');
                }
            });
        })
    </script>
@endsection