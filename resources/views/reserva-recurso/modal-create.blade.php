<div id="CalendarModalNew" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reserva de Recurso</h4>
            </div>

            <form id="antoform" class="form-horizontal calender" role="form" method="post"
                  action="{{ route('reserva-recurso.store') }}">
                <div class="modal-body">
                    <div id="testmodal">

                        {{csrf_field()}}

                        <input type="hidden" id="start" name="start" value="">

                        <div class="form-group">
                            <div class="col-lg-11">
                                <label for="funcionario">Professor</label>
                                <select class="js-states form-control js-example-basic-single" style="width: 100%"
                                        name="funcionario" id="funcionario" autofocus>
                                    @if(count($reservaRecurso['funcionarios']) > 0)
                                        @foreach($reservaRecurso['funcionarios'] as $r)
                                            <option value="{{ $r->id }}">{{ $r->user->nome }}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected>Cadastre um Professor Primeiro</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-1">
                                <a href="" class="btn btn-primary btn-sm" style="margin-top: 25px;">
                                    <em class="fa fa-plus"></em>
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-11">
                                <label for="recurso">Recurso</label>
                                <select class="js-states form-control js-example-basic-single" style="width: 100%"
                                        name="recurso" id="recurso">
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
                            <div class="col-lg-1">
                                <a href="" class="btn btn-primary btn-sm" style="margin-top: 25px;">
                                    <em class="fa fa-plus"></em>
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="aula">Horário</label>
                                <select class="js-states form-control js-example-basic-multiple" style="width: 100%"
                                        name="aula" id="aula">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose" data-dismiss="modal"><em
                                class="fa fa-undo"></em> Voltar
                    </button>
                    <button type="submit" class="btn btn-primary antosubmit"><em class="fa fa-save"></em> Gravar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>