<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use App\Traits\LogTrait;
use App\User;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    use LogTrait;

    protected $user;
    protected $publicacao;

    public function __construct(User $user, Publicacao $publicacao)
    {
        $this->user = $user;
        $this->publicacao = $publicacao;
    }

    public function alunosPendentes()
    {
        $alunos = $this->user
            ->join('alunos', 'alunos.user_id', '=', 'pessoas.id')
            ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->where([['emprestimos.data_devolucao', null], ['emprestimos.data_prevista', '<', Carbon::now()]])
            ->orderBy('emprestimos.data_prevista')
            ->get(['alunos.matricula', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', 'emprestimos.data_prevista']);

        $dataEmissao = Carbon::now()->format("d/m/Y");
        return view('relatorio.alunos-pendentes', compact('alunos', 'dataEmissao'));
    }

    public function funcionariosPendentes()
    {
        $funcionarios = $this->user
            ->join('funcionarios', 'funcionarios.user_id', '=', 'pessoas.id')
            ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->where([['emprestimos.data_devolucao', null], ['emprestimos.data_prevista', '<', Carbon::now()]])
            ->orderBy('emprestimos.data_prevista')
            ->get(['funcionarios.num_registro', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', 'emprestimos.data_prevista']);

        $dataEmissao = Carbon::now()->format("d/m/Y");
        return view('relatorio.funcionarios-pendentes', compact('funcionarios', 'dataEmissao'));
    }

    public function livrosMaisEmprestados()
    {
        $publicacoes = $this->publicacao
            ->join('emprestimos_publicacoes', 'emprestimos_publicacoes.publicacao_id', '=', 'publicacoes.id')
            ->groupBy('publicacoes.id')
            ->orderBy('total', 'desc')
            ->get(['publicacoes.codigo', 'publicacoes.titulo', DB::raw('count(publicacoes.id) as total')]);

        $dataEmissao = Carbon::now()->format("d/m/Y");
        return view('relatorio.publicacoes-emprestadas', compact('publicacoes', 'dataEmissao'));
    }

    public function alunosComMaisEmprestimos()
    {
        $alunos = $this->user
            ->join('alunos', 'alunos.user_id', '=', 'pessoas.id')
            ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->groupBy('emprestimos.user_id')
            ->orderBy('total', 'desc')
            ->orderBy('pessoas.nome', 'asc')
            ->get(['alunos.matricula', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', DB::raw('count(emprestimos.user_id) as total')]);

        $dataEmissao = Carbon::now()->format("d/m/Y");
        return view('relatorio.alunos-emprestimos', compact('alunos', 'dataEmissao'));
    }

    public function funcionariosComMaisEmprestimos()
    {
        $funcionarios = $this->user
            ->join('funcionarios', 'funcionarios.user_id', '=', 'pessoas.id')
            ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->groupBy('emprestimos.user_id')
            ->orderBy('total', 'desc')
            ->orderBy('pessoas.nome', 'asc')
            ->get(['funcionarios.num_registro', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', DB::raw('count(emprestimos.user_id) as total')]);

        $dataEmissao = Carbon::now()->format("d/m/Y");
        return view('relatorio.funcionarios-emprestimos', compact('funcionarios', 'dataEmissao'));
    }
}
