<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditoraRequest;
use App\Repositories\EditoraRepository;
use App\Traits\LogTrait;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

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
        return view('editora.index');
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

    public function getAll()
    {
        $editoras = $this->repository->index();

        return Datatables::of($editoras)
            ->addColumn('action', function ($editora) {
                $html = '<a href="#show" class="btn btn-sm btn-success" data-nome="'. $editora->nome .'"><em class="fa fa-search"></em> Visualizar</a>';
                $html .= '<a href="' . route("editora.edit", $editora->id) . '" class="btn btn-sm btn-warning"><em class="fa fa-pencil"></em> Alterar</a>';
                $html .= '<a href="#modal" class="btn btn-sm btn-danger" data-delete="'. $editora->nome .'" data-id="'. $editora->id.'"><em class="fa fa-trash-o"></em> Excluir</a>';

                return $html;
            })
            ->make(true);
    }
}
