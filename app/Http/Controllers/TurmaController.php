<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurmaRequest;
use App\Http\Requests;
use App\Repositories\TurmaRepository;
use App\Traits\LogTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TurmaController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(TurmaRepository $turmaRepository)
    {
        $this->repository = $turmaRepository;
    }

    public function index()
    {
        $turmas = $this->repository->index();
        return view('turma.index', compact('turmas'));
    }

    public function vinculo($id)
    {
        $turma = $this->repository->findById($id);
        $alunos = $this->repository->getAlunos();
        //dd($alunos);

        return view('turma.vinculo', compact('turma', 'alunos'));
    }

    public function vincular(Request $turmaRequest)
    {
        //dd($turmaRequest->all());
        $gravouAlunos = $this->repository->vincular($turmaRequest->all());

        //dd($gravouAlunos);

        if(!empty($gravouAlunos['attached'])){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('turma.index');
        }
        Session::flash(self::getTipoErroVincular(), self::getMsgErroAlunoDuplicadoTurma());
        return redirect()->back();
    }

    public function vinculados($id)
    {
        $turma = $this->repository->findById($id);
        return view('turma.show', compact('turma'));
    }

    public function create()
    {
        return view('turma.create');
    }

    public function store(TurmaRequest $turmaRequest)
    {
        $retorno = $this->repository->store($turmaRequest->all());
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Turma adicionada!", "informacao", ["Turma" => $retorno->serie]);
            return redirect()->route('turma.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //TODO refazer após implementar no repository
    }

    public function edit($id)
    {
        $turma = $this->repository->findById($id);
        return view('turma.edit', compact('turma'));
    }

    public function update(TurmaRequest $turmaRequest, $id)
    {
        $retorno = $this->repository->update($turmaRequest->all(), $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Turma alterada!", "atencao", ["Turma" => $retorno->nome]);
            return redirect()->route('turma.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Turma excluída!", "alerta");
            return redirect()->route('turma.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroExclusaoTurma());
            return redirect()->back();
        }
    }

    public function destroyVinculo(TurmaRequest $turmaRequest, $id)
    {
        //dd($turmaRequest->all());
        $turma = $this->repository->findById($id);
        $idsAlunos = $turmaRequest->input('ids');

        $arrayIds = explode(',', $idsAlunos);

        $retorno = $turma->alunos()->detach($arrayIds);

        return redirect()->route('turma.index');
    }

    private function brokenIds($ids)
    {


    }
}
