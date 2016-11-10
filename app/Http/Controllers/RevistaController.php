<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevistaRequest;
use App\Http\Requests;
use App\Repositories\RevistaRepository;
use App\Traits\LogTrait;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class RevistaController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(RevistaRepository $revistaRepository)
    {
        $this->repository = $revistaRepository;
    }

    public function index()
    {
        $revistas = $this->repository->index();
        return view('revista.index', compact('revistas'));
    }

    public function create()
    {
        $revistas = $this->repository->create();
        return view('revista.create', compact('revistas'));
    }

    public function store(RevistaRequest $revistaRequest)
    {
        $retorno = $this->repository->store($revistaRequest);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Revista adicionada!", "informacao", ["Revista" => $retorno->titulo]);
            return redirect()->route('revista.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $this->repository->show($id);
    }

    public function edit($id)
    {
        $revista = $this->repository->findById($id);
        $listEditoras = $this->repository->edit();
        return view('revista.edit', compact('revista', 'listEditoras'));
    }

    public function update(RevistaRequest $revistaRequest, $id)
    {
        $retorno = $this->repository->update($revistaRequest, $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Revista alterada!", "atencao", ["Revista" => $retorno->titulo]);
            return redirect()->route('revista.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Revista excluída!", "alerta");
            return redirect()->route('revista.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
