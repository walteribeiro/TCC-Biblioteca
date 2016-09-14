@extends('layout.main')

@section('header')
    @include('log-viewer::_template.style')
@endsection
@section('conteudo')
    <h3 class="page-header">Dashboard</h3>

    @if(isset($percents) && count($percents) > 0)
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-1">
                <log-graph url="/TCC/TCC-Biblioteca/public/chart/sumarizacao"></log-graph>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <section class="box-body">
                    <div class="row">
                        @foreach($percents as $level => $item)
                            <div class="col-lg-4 col-md-3 col-sm-10 col-xs-12">
                                <div class="info-box level level-{{ $level }} {{ $item['count'] === 0 ? 'level-empty' : '' }}">
                                <span class="info-box-icon">
                                    {!! log_styler()->icon($level) !!}
                                </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $item['name'] }}</span>
                                    <span class="info-box-number">
                                        {{ $item['count'] }} ocorrências - {!! $item['percent'] !!} %
                                    </span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    @else
        <h5 class="alert alert-info">Ainda não foram encontradas transações!</h5>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
