@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.min.css')}}">
    <link rel="stylesheet" media="print" href="{{asset('assets/css/fullcalendar.print.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection
@section('conteudo')

    <?php ini_set('display_errors', 1);
    error_reporting(E_ALL); ?>

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

    <!-- Modal criar -->
    @include('reserva-recurso.modal-create')

@endsection
@section('scripts')

    @include('layout.includes.return-request')

    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/js/fullcalendar-pt-br.js')}}"></script>
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/pt-BR.js')}}"></script>

    @if( isset($errors) && count($errors) > 0)
        <script>
            $('#CalendarModalNew').modal('show');
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $(".js-example-basic-single").select2();

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },

                hiddenDays: [0, 6],

                defaultView: 'basicWeek',
                editable: true,
                eventLimit: true,
                selectable: true,
                selectHelper: true,
                eventStartEditable: false,
                displayEventTime: false,
                select: function(start, end) {
                    if(end != start){
                        $('#calendar').fullCalendar('unselect');
                    }

                    $('#CalendarModalNew #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));

                    $('#CalendarModalNew').modal('show');
                },

                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEdit #id').val(event.id);
                        $('#ModalEdit #title').val(event.title);
                        $('#ModalEdit #color').val(event.color);
                        $('#ModalEdit').modal('show');
                    });
                },

                eventDrop: function(event, delta, revertFunc) {
                    edit(event);
                },
                eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
                    edit(event);
                },

                events: function(start, end, timezone, callback) {
                    //debugger;
                    $.ajax({
                        url: 'reserva-recurso/eventos',
                        dataType: 'json',
                        type: 'GET',
                        success: function(doc) {
                            var events = [];
                            $(doc).each(function() {
                                events.push({
                                    title: $(this).attr('title'),
                                    start: $(this).attr('start')
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

            function edit(event){
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if(event.end){
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                }else{
                    end = start;
                }

                id =  event.id;

                Event = [];
                Event[0] = id;
                Event[1] = start;
                Event[2] = end;

                $.ajax({
                    url: 'editEventDate.php',
                    type: "POST",
                    data: {Event:Event},
                    success: function(rep) {
                        if(rep == 'OK'){
                            alert('Saved');
                        }else{
                            alert('Could not be saved. try again.');
                        }
                    }
                });
            }
        });
    </script>
@endsection