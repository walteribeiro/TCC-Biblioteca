<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioRequest;
use App\Models\Funcionario;
use App\Repositories\FuncionarioRepository;
use App\Traits\LogTrait;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class FuncionarioController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(FuncionarioRepository $funcionarioRepository)
    {
        $this->repository = $funcionarioRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('funcionario.index');
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
            $this->gravarLog("Funcionário adicionado!", "informacao", ["Funcionário" => $retorno->nome]);
            return redirect()->route('funcionario.index');
        }
        return redirect()->back();
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
            $this->gravarLog("Funcionário alterado!", "atencao", ["Funcionário" => $retorno->nome]);
            return redirect()->route('funcionario.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Funcionário excluído!", "alerta");
            return redirect()->route('funcionario.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }

    public function getAll()
    {
        $funcionarios = User::whereIn('tipo_pessoa', [0, 1, 2])->get();

        return Datatables::of($funcionarios)
            ->addColumn('tipo', function ($funcionario) {
                if ($funcionario->tipo_pessoa == 0){
                    $html = 'Geral';
                }else if ($funcionario->tipo_pessoa == 1){
                    $html = 'Professor';
                }else{
                    $html = 'Bibliotecário';
                }
                return $html;
            })
            ->addColumn('status', function ($funcionario) {
                if ($funcionario->ativo){
                    $html = '<span class="label label-success">Ativo</span>';
                }else {
                    $html = '<span class="label label-dark">Inativo</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($funcionario) {
                $html = '<a href="#show" class="btn btn-sm btn-success" 
                            data-nome="'. $funcionario->nome .'"
                            data-telefone="'. $funcionario->telefone .'"
                            data-telefone2="'. $funcionario->telefone2 .'"
                            data-email="'. $funcionario->email .'"
                            data-registro="'. $funcionario->matricula .'"
                            data-ativo="'. $funcionario->ativo .'"><em class="fa fa-search"></em> Visualizar</a>';
                $html .= '<a href="' . route("funcionario.edit", $funcionario->id) . '" class="btn btn-sm btn-warning"><em class="fa fa-pencil"></em> Alterar</a>';
                $html .= '<a href="#modal" class="btn btn-sm btn-danger" data-delete="'. $funcionario->nome .'" data-id="'. $funcionario->id.'"><em class="fa fa-trash-o"></em> Excluir</a>';

                if (auth()->user()->tipo_pessoa == 4) {
                    $html .= '<a href="#pass" class="btn btn-sm btn-dark" data-id="'. $funcionario->id .'"><em class="fa fa-unlock"></em> Alterar Senha</a>';
                }else{
                    $html .= '<a href="#" disabled class="btn btn-sm btn-dark"><em class="fa fa-unlock"></em> Alterar Senha</a>';
                }

                return $html;
            })
            ->make(true);
    }
}
