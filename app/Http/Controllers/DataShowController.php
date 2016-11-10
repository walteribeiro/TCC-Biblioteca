<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataShowRequest;
use App\Repositories\DataShowRepository;
use App\Http\Requests;
use App\Traits\LogTrait;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class DataShowController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(DataShowRepository $dataShowRepository)
    {
        $this->repository = $dataShowRepository;
    }

    public function index()
    {
        $dataShows = $this->repository->index();
        return view('data-show.index', compact('dataShows'));
    }

    public function create()
    {
        return view('data-show.create');
    }

    public function store(DataShowRequest $dataShowRequest)
    {
        $retorno = $this->repository->store($dataShowRequest->all());
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Data show adicionado!", "informacao", ["Data show" => $retorno->descricao]);
            return redirect()->route('data-show.index');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $dataShow = $this->repository->findById($id);
        return view('data-show.edit', compact('dataShow'));
    }

    public function update(DataShowRequest $dataShowRequest, $id)
    {
        $value = $this->repository->countDataShows($id, $dataShowRequest->input('codigo'));
        if($value > 0){
            Session::flash(self::getTipoErro(), self::getMsgErroCodigoDataShowDuplicado());
            return redirect()->back();
        }
        $retorno = $this->repository->update($dataShowRequest->all() ,$id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Data show alterado!", "atencao", ["Data show" => $retorno->descricao]);
            return redirect()->route('data-show.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Data show excluído!", "alerta");
            return redirect()->route('data-show.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
