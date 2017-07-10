<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorRequest;
use App\Repositories\AutorRepository;
use App\Http\Requests;
use App\Traits\LogTrait;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class AutorController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(AutorRepository $autorRepository)
    {
        $this->repository = $autorRepository;
    }

    public function index()
    {
        return view('autor.index');
    }

    public function create()
    {
        return view('autor.create');
    }

    public function store(AutorRequest $autorRequest)
    {
        $retorno = $this->repository->store($autorRequest->all());
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Autor adicionado!", "informacao", ["Autor" => $retorno->nome]);
            return redirect()->route('autor.index');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $autor = $this->repository->findById($id);
        return view('autor.edit', compact('autor'));
    }

    public function update(AutorRequest $autorRequest, $id)
    {
        $retorno = $this->repository->update($autorRequest->all(), $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Autor alterado!", "atencao", ["Autor" => $retorno->nome]);
            return redirect()->route('autor.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Autor excluído!", "alerta");
            return redirect()->route('autor.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }

    public function getAll()
    {
        $autores = $this->repository->index();

        return Datatables::of($autores)
            ->addColumn('action', function ($autor) {
                $html = '<a href="#show" class="btn btn-sm btn-success" data-nome="'. $autor->nome .'" data-sobrenome="'. $autor->sobrenome .'"><em class="fa fa-search"></em> Visualizar</a>';
                $html .= '<a href="' . route("autor.edit", $autor->id) . '" class="btn btn-sm btn-warning"><em class="fa fa-pencil"></em> Alterar</a>';
                $html .= '<a href="#modal" class="btn btn-sm btn-danger" data-delete="'. $autor->nome .'" data-id="'. $autor->id.'"><em class="fa fa-trash-o"></em> Excluir</a>';

                return $html;
            })
            ->make(true);
    }
}
