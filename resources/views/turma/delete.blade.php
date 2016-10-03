<div class="modal fade" id="delete-modal" role="dialog" data-backdrop="static">
    <form action="{{ route( 'turma.remove', $turma->id) }}" method="post" id="formexcluir">
        {{ method_field('delete') }}
        {!! csrf_field() !!}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Exclusão</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ids" id="alunos">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <em class="fa fa-undo"></em> Voltar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <em class="fa fa-trash-o"></em> Excluir
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>