<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoRequest;
use App\Models\Publicacao;
use App\Repositories\EmprestimoRepository;
use App\Traits\LogTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class EmprestimoController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(EmprestimoRepository $emprestimoRepository)
    {
        $this->repository = $emprestimoRepository;
    }


    public function index()
    {
        $emprestimos = $this->repository->index();
        return view('emprestimo.index', compact('emprestimos'));
    }

    public function create()
    {
        $usuarios = User::leftJoin('emprestimos', 'pessoas.id', '=', 'emprestimos.user_id')->where('pessoas.tipo_acesso', '<>', 0)->whereNull('emprestimos.id')->get(['pessoas.id', 'pessoas.nome', 'pessoas.tipo_acesso']);
        $publicacoes = Publicacao::whereNotIn('status', [0, 2, 3])->get();
        $data_prevista = Carbon::today()->addDays(7)->format('Y-m-d');
        return view('emprestimo.create', compact('usuarios', 'publicacoes', 'data_prevista'));
    }

    public function store(EmprestimoRequest $emprestimoRequest)
    {
        $gravouEmprestimo = $this->repository->store($emprestimoRequest->all());

        if(!empty($gravouEmprestimo['attached'])){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('emprestimo.index');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Empréstimo excluído!", "alerta");
            return redirect()->route('emprestimo.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
