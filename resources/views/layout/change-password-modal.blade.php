<div class="modal fade" id="change-password-modal" role="dialog" data-backdrop="static">
    <form action="{{ url('/alterar-senha') }}" method="post" id="formchangepassword" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Alterar Senha</h4>
                </div>
                <div class="modal-body">
                    <p></p>
                    <div class="form-group">
                        <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                            <label class="pull-left" for="username">Nome de Usuário
                                <span class="required">*</span>
                            </label>
                            <input type="text" id="username" class="form-control" name="username" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                            <label class="pull-left" for="password">Senha
                                <span class="required">*</span>
                            </label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-8 col-lg-offset-2 col-sm-12">
                            <label class="pull-left" for="password">Confirmação da senha
                                <span class="required">*</span>
                            </label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <em class="fa fa-undo"></em> Voltar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <em class="fa fa-pencil"></em> Alterar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>