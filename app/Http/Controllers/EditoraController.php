<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditoraRequest;
use App\Repositories\EditoraRepository;
use App\Http\Requests;
use App\Traits\LogTrait;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class EditoraController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(EditoraRepository $editoraRepository)
    {
        $this->repository = $editoraRepository;
    }

    public function index()
    {
        $editoras = $this->repository->index();
        return view('editora.index', compact('editoras'));
    }

    public function create()
    {
        return view('editora.create');
    }

    public function store(EditoraRequest $editoraRequest)
    {
        $retorno = $this->repository->store($editoraRequest->all());
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Editora adicionada!", "informacao", ["Editora" => $retorno->nome]);
            return redirect()->route('editora.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //TODO refazer após implementar no repository
    }

    public function edit($id)
    {
        $editora = $this->repository->findById($id);
        return view('editora.edit', compact('editora'));
    }

    public function update(EditoraRequest $editoraRequest, $id)
    {
        $retorno = $this->repository->update($editoraRequest->all(), $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Editora alterada!", "atencao", ["Editora" => $retorno->nome]);
            return redirect()->route('editora.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Editora excluída!", "alerta");
            return redirect()->route('editora.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
