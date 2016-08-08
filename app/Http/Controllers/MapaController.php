<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapaRequest;
use App\Repositories\MapaRepository;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class MapaController extends Controller
{
    protected $repository;

    public function __construct(MapaRepository $mapaRepository)
    {
        $this->repository = $mapaRepository;
    }

    public function index()
    {
        $mapas = $this->repository->index();
        return view('mapa.index', compact('mapas'));
    }

    public function create()
    {
        return view('mapa.create');
    }

    public function store(MapaRequest $mapaRequest)
    {
        $retorno = $this->repository->store($mapaRequest->all());
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('mapa.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //TODO refazer após implementar no repository
    }

    public function edit($id)
    {
        $mapa = $this->repository->findById($id);
        return view('mapa.edit', compact('mapa'));
    }

    public function update(MapaRequest $mapaRequest, $id)
    {
        $retorno = $this->repository->update($mapaRequest->all() ,$id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('mapa.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('mapa.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
