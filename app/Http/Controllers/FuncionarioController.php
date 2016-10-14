<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioRequest;
use App\Models\Funcionario;
use App\Repositories\FuncionarioRepository;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class FuncionarioController extends Controller
{
    protected $repository;

    public function __construct(FuncionarioRepository $funcionarioRepository)
    {
        $this->repository = $funcionarioRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->hasPermission()) {
            $funcionarios = $this->repository->index();
            return view('funcionario.index', compact('funcionarios'));
        }
        return $this->returnHomePage();
    }

    public function create()
    {
        return view('funcionario.create');
    }

    public function store(FuncionarioRequest $funcionarioRequest)
    {
        $retorno = $this->repository->store($funcionarioRequest);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('funcionario.index');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //TODO refazer após implementar no repository
    }

    public function edit($id)
    {
        $funcionario = $this->repository->findById($id);
        return view('funcionario.edit', compact('funcionario'));
    }

    public function update(FuncionarioRequest $funcionarioRequest, $id)
    {

        $retorno = $this->repository->update($funcionarioRequest, $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('funcionario.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('funcionario.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
