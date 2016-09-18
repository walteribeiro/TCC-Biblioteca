<div id="calendar-delete" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     data-backdrop="static" style="margin-top: 60px">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Exclusão</h4>
            </div>

            <form id="delete-form" class="form-horizontal" role="form">
                <div class="modal-body">

                    {{csrf_field()}}

                    <input type="hidden" id="delete-id" name="id" value="">
                    <input type="hidden" id="delete-data" name="data" value="">
                    <p></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <em class="fa fa-undo"></em> Voltar
                    </button>
                    <button type="button" class="btn btn-danger" id="submit-delete-form">
                        <em class="fa fa-trash-o"></em> Excluir
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>