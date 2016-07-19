<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevistaRequest;
use App\Http\Requests;
use App\Repositories\RevistaRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class RevistaController extends Controller
{

    protected $repository;

    public function __construct(RevistaRepository $revistaRepository)
    {
        $this->repository = $revistaRepository;
        $this->middleware('auth');

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
        $publicacao = $this->repository->findById($id);
        $listEditoras = $this->repository->edit();
        return view('revista.edit', compact('publicacao', 'listEditoras'));
    }

    public function update(RevistaRequest $revistaRequest, $id)
    {
        $retorno = $this->repository->update($revistaRequest,$id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('revista.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('revista.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
