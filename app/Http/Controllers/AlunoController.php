<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
use App\Models\Aluno;
use App\Repositories\AlunoRepository;
use App\Traits\LogTrait;
use App\User;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class AlunoController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->repository = $alunoRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('aluno.index');
    }

    public function create()
    {
        return view('aluno.create');
    }

    public function store(AlunoRequest $request)
    {
        $retorno = $this->repository->store($request);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Aluno adicionado!", "informacao", ["Aluno" => $retorno->nome]);
            return redirect()->route('aluno.index');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $aluno = $this->repository->findById($id);
        return view('aluno.edit', compact('aluno'));
    }

    public function update(AlunoRequest $alunoRequest, $id)
    {
        $retorno = $this->repository->update($alunoRequest, $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Aluno alterado!", "atencao", ["Aluno" => $retorno->nome]);
            return redirect()->route('aluno.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Aluno excluído!", "alerta");
            return redirect()->route('aluno.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }

    public function getAll()
    {
        $alunos = User::where('tipo_pessoa', 3)->get();

        return Datatables::of($alunos)
            ->addColumn('status', function ($aluno) {
                if ($aluno->ativo){
                    $html = '<span class="label label-success">Ativo</span>';
                }else {
                    $html = '<span class="label label-dark">Inativo</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($aluno) {
                $html = '<a href="#show" class="btn btn-sm btn-success"
                            data-nome="'. $aluno->nome .'"
                            data-telefone="'. $aluno->telefone .'"
                            data-telefone2="'. $aluno->telefone2 .'"
                            data-email="'. $aluno->email .'"
                            data-registro="'. $aluno->matricula .'"
                            data-ativo="'. $aluno->ativo .'"><em class="fa fa-search"></em> Visualizar</a>';
                $html .= '<a href="' . route("aluno.edit", $aluno->id) . '" class="btn btn-sm btn-warning"><em class="fa fa-pencil"></em> Alterar</a>';
                $html .= '<a href="#modal" class="btn btn-sm btn-danger" data-delete="'. $aluno->nome .'" data-id="'. $aluno->id.'"><em class="fa fa-trash-o"></em> Excluir</a>';

                if (auth()->user()->tipo_pessoa == 4) {
                    $html .= '<a href="#pass" class="btn btn-sm btn-dark" data-id="'. $aluno->id .'"><em class="fa fa-unlock"></em> Alterar Senha</a>';
                }else{
                    $html .= '<a href="#" disabled class="btn btn-sm btn-dark"><em class="fa fa-unlock"></em> Alterar Senha</a>';
                }

                return $html;
            })
            ->make(true);
    }
}
