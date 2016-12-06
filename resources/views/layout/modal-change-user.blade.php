<div class="modal fade" id="change-user-modal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mudar de Usuário</h4>
            </div>
            <form method="POST" class="form-horizontal" action="{{ url('/login') }}">

                <input type="hidden" name="mudarUsuario" value="sim">

                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                            <label class="pull-left" for="username">Nome de Usuário</label>
                            <input type="text" id="username" class="form-control" name="username" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                            <label class="pull-left" for="password">Senha</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark submit">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>