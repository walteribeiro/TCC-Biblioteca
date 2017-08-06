<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoRequest;
use App\Models\Emprestimo;
use App\Models\Publicacao;
use App\Repositories\EmprestimoRepository;
use App\Traits\LogTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

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
        return view('emprestimo.index');
    }

    public function create()
    {
        $usuarios = User::whereNotIn('id', function($query){
            $query->select('pessoas.id')
                ->from('pessoas')
                ->join('emprestimos', 'pessoas.id', '=', 'emprestimos.user_id')
                ->where('emprestimos.situacao', '0');
        })->where([['tipo_pessoa', '<>', 4], ['ativo', '=', '1']])
            ->get(['id', 'nome', 'tipo_pessoa']);

        $publicacoes = Publicacao::whereNotIn('status', [0, 2, 3])->get();
        $data_prevista = Carbon::today()->addDays(7)->format('Y-m-d');
        return view('emprestimo.create', compact('usuarios', 'publicacoes', 'data_prevista'));
    }

    public function store(EmprestimoRequest $emprestimoRequest)
    {
        $gravouEmprestimo = $this->repository->store($emprestimoRequest->all());

        if(!empty($gravouEmprestimo['attached'])){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Empréstimo adicionado!", "informacao", ["Data" => Carbon::today()->format('d/m/Y')]);
            return redirect()->route('emprestimo.index');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $emprestimo = $this->repository->findById($id);
        return view("emprestimo.edit", compact('emprestimo'));
    }

    public function update(EmprestimoRequest $emprestimoRequest, $id)
    {
        $retorno = $this->repository->update($emprestimoRequest->all(), $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Empréstimo alterado!", "atencao", ["Data" => Carbon::today()->format('d/m/Y')]);
            return redirect()->route('emprestimo.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Empréstimo excluído!", "alerta", ["Data" => Carbon::today()->format('d/m/Y')]);
            return redirect()->route('emprestimo.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }

    public function devolverEmprestimo($id)
    {
        $retorno = $this->repository->devolver($id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgDevolucao());
            $this->gravarLog("Empréstimo devolvido!", "alerta", ["Data" => Carbon::today()->format('d/m/Y')]);
            return redirect()->route('emprestimo.index');
        }
        return redirect()->back();
    }

    public function getAll()
    {
        $emprestimos = Emprestimo::join('pessoas', 'pessoas.id', '=', 'emprestimos.user_id')
            ->get(['emprestimos.id', 'pessoas.nome', 'emprestimos.data_emprestimo', 'emprestimos.data_devolucao', 'emprestimos.data_prevista', 'emprestimos.situacao']);

        return Datatables::of($emprestimos)
            ->addColumn('situacao', function ($emprestimo) {
                if ($emprestimo->situacao == 0){
                    $html = '<span class="label label-success">Aberto</span>';
                }else{
                    $html = '<span class="label label-primary">Devolvido</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($emprestimo) {
                if ($emprestimo->situacao == 0) {
                    $html = '<a href="#devolver" class="btn btn-sm btn-primary" 
                                data-devolver="'. $emprestimo->data_emprestimo .'" 
                                data-id="'. $emprestimo->id .'"><em class="fa fa-ban"></em> Devolver</a>';
                }else{
                    $html = '<button disabled class="btn btn-sm btn-primary">
                                <em class="fa fa-ban"></em> Devolver
                            </button>';
                }

                $html .= '<a href="#show" class="btn btn-sm btn-success" 
                            data-situacao="'. $emprestimo->situacao .'"
                            data-data_emprestimo="'. $emprestimo->data_emprestimo .'"
                            data-data_devolucao="'. $emprestimo->data_devolucao .'"
                            data-data_prevista="'. $emprestimo->data_prevista .'"<em class="fa fa-search"></em> Visualizar</a>';

                if ($emprestimo->situacao == 0) {
                    $html .= '<a href="' . route("emprestimo.edit", $emprestimo->id) . '" class="btn btn-sm btn-warning"><em class="fa fa-pencil"></em> Alterar</a>';
                    $html .= '<a href="#modal" class="btn btn-sm btn-danger" data-delete="' . $emprestimo->data_emprestimo . '" data-id="' . $emprestimo->id . '"><em class="fa fa-trash-o"></em> Excluir</a>';
                }else{
                    $html .= '<button disabled class="btn btn-sm btn-warning">
                                <em class="fa fa-pencil"></em> Alterar
                              </button>
                              <button disabled class="btn btn-sm btn-danger">
                                <em class="fa fa-trash-o"></em> Excluir
                              </button>';
                }

                return $html;
            })
            ->make(true);
    }
}
