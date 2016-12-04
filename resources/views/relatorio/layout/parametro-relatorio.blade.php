<div class="row">
    <div class="col-lg-offset-3 col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Parâmetros do Relatório</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                        <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display: none">
                <form class="form-horizontal" action="{{ route($rota) }}" method="get">

                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-2 col-sm-12">
                            <label for="dtInicial">Data inicial</label>
                            <input type="date" required class="form-control" id="dtInicial" name="dtInicial"
                                   value="{{ $dtInicial }}" autofocus>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <label for="dtFinal">Data final</label>
                            <input type="date" required class="form-control" id="dtFinal" name="dtFinal"
                                   value="{{ $dtFinal }}">
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark pull-right">
                            <em class="fa fa-gear"></em> Gerar Relatório
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>