<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
use App\Repositories\AlunoRepository;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{
    protected $repository;

    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->repository = $alunoRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $alunos = $this->repository->index();
        return view('aluno.index', compact('alunos'));
    }

    public function create()
    {
        return view('aluno.create');
    }

    public function store(AlunoRequest $request)
    {
        $retorno = $this->repository->store($request);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('aluno.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //TODO refazer após implementar no repository
    }

    public function edit($id)
    {
        $aluno = $this->repository->findById($id);
        return view('aluno.edit', compact('aluno'));
    }

    public function update(AlunoRequest $alunoRequest, $id)
    {

        $retorno = $this->repository->update($alunoRequest, $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('aluno.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('aluno.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
