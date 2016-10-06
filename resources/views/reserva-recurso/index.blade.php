@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.min.css')}}">
    <link rel="stylesheet" media="print" href="{{asset('assets/css/fullcalendar.print.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection
@section('conteudo')

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Calendário de Reservas de Recurso</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    @include('reserva-recurso.modal-create')

    @include('reserva-recurso.modal-edit')

    @include('reserva-recurso.modal-delete')

@endsection
@section('scripts')

    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/js/fullcalendar-pt-br.js')}}"></script>
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/pt-BR.js')}}"></script>

    <script>
        $(document).ready(function() {
            $(".basic-select").select2();
            $(".basic-select-no-search").select2({
                minimumResultsForSearch: Infinity
            });

            $('#submit-create-form').on('click', function(e){
                e.preventDefault();

                doSubmitCreateForm();
            });

            // Efetua a requisição do formulário de criação
            function doSubmitCreateForm(){
                $("#calendar-create").modal('hide');
                var nome = $('#recurso option:selected').text();
                var func = $("#funcionario").val();
                var turno = $('#aula option:selected').text();
                var aula = $('#aula').val();
                var recurso = $('#recurso').val();
                var dtStart = $('#start').val();

                var dataObj = {
                    title: nome + " - " + turno,
                    start: dtStart,
                    end: dtStart,
                    funcionario: func,
                    aula: aula,
                    recurso: recurso
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    }
                });

                $.ajax({
                    url: '{{ route("reserva-recurso.store") }}',
                    data: dataObj,
                    type: 'post',
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        dataObj.id = response.id;
                        $('#calendar').fullCalendar('renderEvent', dataObj, true);

                        $('#calendar').fullCalendar('unselect');

                        var options = {
                            "closeButton": true
                        };
                        toastr.success("Registro incluído com sucesso!", 'Sucesso!', options);
                    },
                    error: function(e){
                        console.log(e);
                        var errors = e.responseJSON;
                        var li = "";
                        var options = {
                            "closeButton": true
                        };

                        $.each(errors, function(index, value) {
                            li += "<li>" + value + '</li>';
                        });
                        console.log(li);
                        toastr.error(li, 'Erro!', options);
                    }
                });
            }

            $('#submit-edit-form').on('click', function(e){
                e.preventDefault();

                doSubmitEditForm();
            });

            // Efetua a requisição do formulário de edição
            function doSubmitEditForm(){
                $("#calendar-edit").modal('hide');
                var identif = $("#edit-id").val();
                var nome = $('#edit-recurso option:selected').text();
                var func = $('#edit-funcionario').val();
                var turno = $('#edit-aula option:selected').text();
                var aula = $('#edit-aula').val();
                var recurso = $('#edit-recurso').val();
                var dtStart = $('#edit-start').val();

                var dataObj = {
                    id: identif,
                    title: nome + " - " + turno,
                    start: dtStart,
                    end: dtStart,
                    funcionario: func,
                    aula: aula,
                    recurso: recurso
                };
                console.log(dataObj);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#edit-form input[name="_token"]').attr('value')
                    }
                });

                $.ajax({
                    url: '{{ route("reserva-recurso.update") }}',
                    data: dataObj,
                    type: 'put',
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        dataObj.id = response.id;

                        $('#calendar').fullCalendar('removeEvents');
                        $('#calendar').fullCalendar('refetchEvents');

                        var options = {
                            "closeButton": true
                        };
                        toastr.success("Registro alterado com sucesso!", 'Sucesso!', options);
                    },
                    error: function(e){
                        console.log(e);
                        var errors = e.responseJSON;
                        var li = "";
                        var options = {
                            "closeButton": true
                        };

                        $.each(errors, function(index, value) {
                            li += "<li>" + value + '</li>';
                        });
                        console.log(li);
                        toastr.error(li, 'Erro!', options);
                    }
                });
            }

            // Abrir modal de delete
            $('#open-delete-form').on('click', function(e){
                e.preventDefault();

                var dt = $('#delete-data').val();
                var modal = $('#calendar-delete');

                modal.find('.modal-body p').html(
                        'Você tem certeza que deseja excluir a reserva do dia ' + dt + ' ?'
                );
                modal.modal('show');
            });

            // Submit modal de delete
            $('#submit-delete-form').on('click', function(e){
                e.preventDefault();

                doSubmitDeleteForm();
            });

            // Efetua a requisição do formulário de deleção
            function doSubmitDeleteForm(){
                $("#calendar-delete").modal('hide');
                $("#calendar-edit").modal('hide');
                var identif = $("#delete-id").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#delete-form input[name="_token"]').attr('value')
                    }
                });

                $.ajax({
                    url: 'reserva-recurso/remover/'+ identif,
                    type: 'delete',
                    success: function(response){
                        console.log(response);

                        $('#calendar').fullCalendar('removeEvents', [ identif ]);

                        var options = {
                            "closeButton": true
                        };
                        toastr.success(response.mensagem, 'Sucesso!', options);
                    },
                    error: function(e){
                        console.log(e);
                        var errors = e.responseJSON;
                        var li = "";
                        var options = {
                            "closeButton": true
                        };

                        $.each(errors, function(index, value) {
                            li += "<li>" + value + '</li>';
                        });
                        console.log(li);
                        toastr.error(li, 'Erro!', options);
                    }
                });
            }

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'prevYear,nextYear month,basicWeek,basicDay'
                },
                buttonText: {
                    today: 'Dia Atual'
                },

                hiddenDays: [0, 6],
                selectable: true,
                displayEventTime: false,
                defaultView: 'basicWeek',

                select: function(start, end) {
                    if(end != start){
                        $('#calendar').fullCalendar('unselect');
                    }
                    $('#start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#calendar-create').modal('show');
                },

                eventClick: function(event, jsEvent, view) {
                    console.log("ID: " + event.id);
                    console.log("Professor: " + event.funcionario);
                    console.log("Recurso: " + event.recurso);
                    console.log("Horário: " + event.aula);
                    console.log("Data: " + event.start);

                    //$('#edit-aula option[value=' + event.aula + ']').attr('selected', true).trigger("change");
                    $('#delete-id').val(event.id);
                    $('#delete-data').val(event.start.format("DD/MM/YYYY"));
                    $('#edit-id').val(event.id);
                    $('#edit-start').val(event.start.format("YYYY-MM-DD HH:mm:ss"));
                    $('#edit-funcionario').val(event.funcionario).trigger("change");
                    $('#edit-recurso').val(event.recurso).trigger("change");
                    $('#edit-aula').val(event.aula).trigger("change");

                    $('#calendar-edit').modal('show');
                },

                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: 'reserva-recurso/eventos',
                        dataType: 'json',
                        type: 'get',
                        success: function(doc) {
                            var events = [];
                            $(doc).each(function() {
                                events.push({
                                    id: $(this).attr('id'),
                                    title: $(this).attr('title'),
                                    start: $(this).attr('start'),
                                    end: $(this).attr('end'),
                                    funcionario: $(this).attr('professor'),
                                    recurso: $(this).attr('recurso'),
                                    aula: $(this).attr('aula')
                                });
                            });
                            callback(events);
                        },
                        error: function (xmlHttpRequest, textStatus, errorThrown) {
                            console.log(xmlHttpRequest);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                }
            });

            function getFreshEvents(){
                $.ajax({
                    url: 'reserva-recurso/eventos',
                    type: 'get',
                    async: false,
                    success: function(s){
                        freshevents = s;
                    }
                });
                $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
            }

            function cleanForms(){

            }
        })
    </script>
@endsection