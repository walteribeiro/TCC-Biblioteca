<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaRequest;
use App\Repositories\SalaRepository;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class SalaController extends Controller
{
    protected $repository;

    public function __construct(SalaRepository $salaRepository)
    {
        $this->repository = $salaRepository;
    }

    public function index()
    {
        $salas = $this->repository->index();
        return view('sala.index', compact('salas'));
    }

    public function create()
    {
        return view('sala.create');
    }

    public function store(SalaRequest $salaRequest)
    {
        $retorno = $this->repository->store($salaRequest->all());
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('sala.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //TODO refazer após implementar no repository
    }

    public function edit($id)
    {
        $sala = $this->repository->findById($id);
        return view('sala.edit', compact('sala'));
    }

    public function update(SalaRequest $salaRequest, $id)
    {
        $retorno = $this->repository->update($salaRequest->all() ,$id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('sala.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('sala.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
