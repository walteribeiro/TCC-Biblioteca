@extends('layout.main')

@section('conteudo')

    <h3 class="col-lg-6 col-lg-offset-3 col-sm-12 crud-title">Edição de turma</h3>

    <form class="form-horizontal" action="{{ route('turma.update', $turma->id) }}" method="post">

        {{ method_field('put') }}
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3 col-sm-12">
                <label for="serie">Série
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="serie" name="serie"
                       placeholder="Série" autofocus value="{{ $turma->serie }}">
            </div>

            <div class="col-lg-3 col-sm-12">
                <label for="turno">Turno</label>
                <select class="form-control" name="turno" id="turno">
                    <option value="0" {{$turma->turno == 0 ? 'selected' : ''}}>Manhã</option>
                    <option value="1" {{$turma->turno == 1 ? 'selected' : ''}}>Tarde</option>
                    <option value="2" {{$turma->turno == 2 ? 'selected' : ''}}>Noite</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-3 col-sm-12">
                <label for="ano">Ano
                    <span class="required">*</span>
                </label>
                <input type="number" class="form-control" id="ano" name="ano"
                       placeholder="Ano" value="{{ $turma->ano }}" data-inputmask="'mask': '9999'">
            </div>

            <div class="col-lg-2">
                <label for="ensino">Ensino</label>
                <select class="form-control" name="ensino" id="ensino">
                    <option value="0" {{$turma->ensino == 0 ? 'selected' : ''}}>Fundamental</option>
                    <option value="1" {{$turma->ensino == 1 ? 'selected' : ''}}>Médio</option>
                    <option value="2" {{$turma->ensino == 2 ? 'selected' : ''}}>Superior</option>
                </select>
            </div>

            <div class="col-lg-2">
                <label for="letraTurma">Letra
                    <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="letraTurma" name="letraTurma"
                       placeholder="Letra" value="{{ $turma->letra_turma }}" data-inputmask="'mask': 'a'">
            </div>
        </div>

        <br>
        <div class="form-group">
            <div class="col-lg-3 col-lg-offset-3">
                <button type="submit" class="btn btn-primary"><em class="fa fa-save"></em> Gravar</button>
                <a href="{{ route('turma.index') }}" class="btn btn-default"><em class="fa fa-undo"></em> Voltar</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="{{ asset("assets/js/jquery.inputmask.bundle.min.js")}}"></script>
    <script>
        $(document).ready(function () {
            $(":input").inputmask();
        })
    </script>
@endsection