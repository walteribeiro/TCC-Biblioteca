<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRecursoRequest;
use App\Repositories\ReservaRecursoRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ReservaRecursoController extends Controller
{
    protected $repository;

    public function __construct(ReservaRecursoRepository $reservaRecursoRepository)
    {
        $this->repository = $reservaRecursoRepository;
    }


    public function index()
    {
        $reservaRecurso = $this->repository->index();
        return view('reserva-recurso.index', compact('reservaRecurso'));
    }


    public function create()
    {
        $reservaRecurso = $this->repository->create();
        return view('reserva-recurso.create', compact('reservaRecurso'));
    }

    public function store(ReservaRecursoRequest $reservaRecursoRequest)
    {
        $retorno = $this->repository->store($reservaRecursoRequest->all());
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('reserva-recurso.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //TODO refazer após implementar no repository
    }

    public function edit($id)
    {
        $reservaRecurso = $this->repository->findById($id);
        $listFuncionariosRecursos = $this->repository->edit();
        return view('reserva-recurso.edit', compact('reservaRecurso', 'listFuncionariosRecursos'));
    }

    public function update(ReservaRecursoRequest $reservaRecursoRequest, $id)
    {
        $retorno = $this->repository->update($reservaRecursoRequest->all(), $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('reserva-recurso.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('reserva-recurso.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
