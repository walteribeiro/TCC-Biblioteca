<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorRequest;
use App\Repositories\AutorRepository;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class AutorController extends Controller
{
    protected $repository;

    public function __construct(AutorRepository $autorRepository)
    {
        $this->repository = $autorRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $autores = $this->repository->index();
        return view('autor.index', compact('autores'));
    }

    public function create()
    {
        return view('autor.create');
    }

    public function store(AutorRequest $autorRequest)
    {
        $retorno = $this->repository->store($autorRequest);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('autor.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $this->repository->show($id);
    }

    public function edit($id)
    {
        $autor = $this->repository->findById($id);
        return view('autor.edit', compact('autor'));
    }

    public function update(AutorRequest $autorRequest, $id)
    {
        $retorno = $this->repository->update($autorRequest, $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('autor.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('autor.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
