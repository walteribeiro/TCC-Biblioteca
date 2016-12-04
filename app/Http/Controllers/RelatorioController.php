<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use App\Traits\LogTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use mPDF;

class RelatorioController extends Controller
{
    use LogTrait;

    protected $user;
    protected $publicacao;

    private static $ALUNOS_PENDENTES = 'RELATÓRIO DE ALUNOS PENDENTES';
    private static $FUNCIONARIOS_PENDENTES = 'RELATÓRIO DE FUNCIONÁRIOS PENDENTES';
    private static $PUBLICACOES_MAIS_EMPRESTADOS = 'RELATÓRIO DE PUBLICAÇÕES MAIS EMPRESTADAS';
    private static $ALUNOS_MAIS_EMPRESTIMOS = 'RELATÓRIO DE ALUNOS COM MAIS EMPRÉSTIMOS';
    private static $FUNCIONARIOS_MAIS_EMPRESTIMOS = 'RELATÓRIO DE FUNCIONÁRIOS COM MAIS EMPRÉSTIMOS';

    public function __construct(User $user, Publicacao $publicacao)
    {
        $this->user = $user;
        $this->publicacao = $publicacao;
    }
    
    // Alunos Pendentes
    public function alunosPendentes(Request $request)
    {
        $dtInicialRel = $request->input('dtInicial');
        $dtFinalRel = $request->input('dtFinal');

        if($dtInicialRel && $dtFinalRel){
            if($dtInicialRel > $dtFinalRel){
                Session::flash(self::getTipoSemPermission(), 'Data inicial não pode ser maior que a data final!');
                return redirect()->back();
            }
        }

        $alunos = $this->getAlunosPendentes($dtInicialRel, $dtFinalRel);
        $dataEmissao = $this->getDataEmissao();
        $dtInicial = $this->getDataInicial("Y-m-d");
        $dtFinal = $this->getDataFinal("Y-m-d");
        $rota = "aluno.pendente";
        return view('relatorio.alunos-pendentes', compact('alunos', 'dataEmissao', 'dtInicial', 'dtFinal', 'rota'));
    }

    public function gerarPDFAlunosPendentes()
    {
        $dados = $this->getAlunosPendentes();
        $view = view('relatorio.pdfs.pdf-alunos-pendentes', compact('dados'));
        return $this->getInstancePDF('Alunos Pendentes', 'Alunos_Pendentes', false, $view, self::$ALUNOS_PENDENTES);
    }

    public function baixarPDFAlunosPendentes()
    {
        $dados = $this->getAlunosPendentes();
        $view = view('relatorio.pdfs.pdf-alunos-pendentes', compact('dados'));
        return $this->getInstancePDF('Alunos Pendentes', 'Alunos_Pendentes', true, $view, self::$ALUNOS_PENDENTES);
    }
    // Fim

    // Funcionários Pendentes
    public function funcionariosPendentes()
    {
        $funcionarios = $this->getFuncionariosPendentes();
        $dataEmissao = $this->getDataEmissao();
        return view('relatorio.funcionarios-pendentes', compact('funcionarios', 'dataEmissao'));
    }

    public function gerarPDFFuncionariosPendentes()
    {
        $dados = $this->getFuncionariosPendentes();
        $view = view('relatorio.pdfs.pdf-funcionarios-pendentes', compact('dados'));
        return $this->getInstancePDF('Funcionarios Pendentes', 'Funcionarios_Pendentes', false, $view, self::$FUNCIONARIOS_PENDENTES);
    }

    public function baixarPDFFuncionariosPendentes()
    {
        $dados = $this->getFuncionariosPendentes();
        $view = view('relatorio.pdfs.pdf-funcionarios-pendentes', compact('dados'));
        return $this->getInstancePDF('Funcionarios Pendentes', 'Funcionarios_Pendentes', true, $view, self::$FUNCIONARIOS_PENDENTES);
    }
    // Fim

    // Publicações Mais Emprestados
    public function publicacoesMaisEmprestadas()
    {
        $publicacoes = $this->getPublicacoesMaisEmprestadas();
        $dataEmissao = $this->getDataEmissao();
        return view('relatorio.publicacoes-emprestadas', compact('publicacoes', 'dataEmissao'));
    }

    public function gerarPDFPublicacoesMaisEmprestadas()
    {
        $dados = $this->getPublicacoesMaisEmprestadas();
        $view = view('relatorio.pdfs.pdf-publicacoes-mais-emprestadas', compact('dados'));
        return $this->getInstancePDF('Publicações Mais Emprestadas', 'Publicações_Mais_Emprestadas', false, $view, self::$PUBLICACOES_MAIS_EMPRESTADOS);
    }

    public function baixarPDFPublicacoesMaisEmprestadas()
    {
        $dados = $this->getPublicacoesMaisEmprestadas();
        $view = view('relatorio.pdfs.pdf-publicacoes-mais-emprestadas', compact('dados'));
        return $this->getInstancePDF('Publicações Mais Emprestadas', 'Publicações_Mais_Emprestadas', true, $view, self::$PUBLICACOES_MAIS_EMPRESTADOS);
    }
    // Fim

    // Alunos Com Mais Empréstimos
    public function alunosComMaisEmprestimos()
    {
        $alunos = $this->getAlunosComMaisEmprestimos();
        $dataEmissao = $this->getDataEmissao();
        return view('relatorio.alunos-emprestimos', compact('alunos', 'dataEmissao'));
    }

    public function gerarPDFAlunosComMaisEmprestimos()
    {
        $dados = $this->getAlunosComMaisEmprestimos();
        $view = view('relatorio.pdfs.pdf-alunos-emprestimos', compact('dados'));
        return $this->getInstancePDF('Alunos Com Mais Empréstimos', 'Alunos_Com_Mais_Empréstimos', false, $view, self::$ALUNOS_MAIS_EMPRESTIMOS);
    }

    public function baixarPDFAlunosComMaisEmprestimos()
    {
        $dados = $this->getAlunosComMaisEmprestimos();
        $view = view('relatorio.pdfs.pdf-alunos-emprestimos', compact('dados'));
        return $this->getInstancePDF('Alunos Com Mais Empréstimos', 'Alunos_Com_Mais_Empréstimos', true, $view, self::$ALUNOS_MAIS_EMPRESTIMOS);
    }
    // Fim

    // Funcionários Com Mais Empréstimos
    public function funcionariosComMaisEmprestimos()
    {
        $funcionarios = $this->getFuncionariosComMaisEmprestimos();
        $dataEmissao = $this->getDataEmissao();
        return view('relatorio.funcionarios-emprestimos', compact('funcionarios', 'dataEmissao'));
    }

    public function gerarPDFFuncionariosComMaisEmprestimos()
    {
        $dados = $this->getFuncionariosComMaisEmprestimos();
        $view = view('relatorio.pdfs.pdf-funcionarios-emprestimos', compact('dados'));
        return $this->getInstancePDF('Funcionários Com Mais Empréstimos', 'Funcionários_Com_Mais_Empréstimos', false, $view, self::$FUNCIONARIOS_MAIS_EMPRESTIMOS);
    }

    public function baixarPDFFuncionariosComMaisEmprestimos()
    {
        $dados = $this->getFuncionariosComMaisEmprestimos();
        $view = view('relatorio.pdfs.pdf-funcionarios-emprestimos', compact('dados'));
        return $this->getInstancePDF('Funcionários Com Mais Empréstimos', 'Funcionários_Com_Mais_Empréstimos', true, $view, self::$FUNCIONARIOS_MAIS_EMPRESTIMOS);
    }
    // Fim


    /*
     |------------------------------------------------------------------------------------------------------------------
     | Funções Utéis
     |------------------------------------------------------------------------------------------------------------------
    */

    private function getInstancePDF($titlePDF = 'Relatorio', $name = 'Relatorio', $isDownload = false, $htmlToRender, $titulo)
    {
        $css = file_get_contents(asset('assets/css/relatorio.css'));

        $mpdf = new Mpdf();
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHTMLHeader($this->getHeader($titulo));
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->AddPage('', '', '', '', '', 10, 10, 30);
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($htmlToRender);
        $mpdf->title = $titlePDF;

        return $mpdf->Output($name.$this->getDataEmissao('_d-m-Y_H:i').'.pdf', ( $isDownload ? 'D' : 'I'));
    }

    private function getDataEmissao($fmt = 'd/m/Y')
    {
        return Carbon::now()->format($fmt);
    }

    private function getDataInicial($fmt = 'd/m/Y')
    {
        return Carbon::now()->startOfMonth()->format($fmt);
    }

    private function getDataFinal($fmt = 'd/m/Y')
    {
        return Carbon::now()->endOfMonth()->format($fmt);
    }

    private function getHeader($titulo)
    {
        return view('relatorio.layout.cabecalho-padrao')->with('dataEmissao', $this->getDataEmissao())->with('titulo', $titulo);
    }
    
    private function getAlunosPendentes($dtInicial = null, $dtFinal = null)
    {
        if($dtInicial){
            return $this->user
                ->join('alunos', 'alunos.user_id', '=', 'pessoas.id')
                ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
                ->where([['emprestimos.data_devolucao', null], ['emprestimos.data_prevista', '<', Carbon::now()]])
                ->whereBetween('emprestimos.data_prevista', array($dtInicial, $dtFinal))
                ->orderBy('emprestimos.data_prevista')
                ->get(['alunos.matricula', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', 'emprestimos.data_prevista']);
        }

        return $this->user
            ->join('alunos', 'alunos.user_id', '=', 'pessoas.id')
            ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->where([['emprestimos.data_devolucao', null], ['emprestimos.data_prevista', '<', Carbon::now()]])
            ->orderBy('emprestimos.data_prevista')
            ->get(['alunos.matricula', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', 'emprestimos.data_prevista']);
    }

    private function getFuncionariosPendentes()
    {
        return $this->user
            ->join('funcionarios', 'funcionarios.user_id', '=', 'pessoas.id')
            ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->where([['emprestimos.data_devolucao', null], ['emprestimos.data_prevista', '<', Carbon::now()]])
            ->orderBy('emprestimos.data_prevista')
            ->get(['funcionarios.num_registro', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', 'emprestimos.data_prevista']);
    }

    private function getPublicacoesMaisEmprestadas()
    {
        return $this->publicacao
            ->join('emprestimos_publicacoes', 'emprestimos_publicacoes.publicacao_id', '=', 'publicacoes.id')
            ->groupBy('publicacoes.id')
            ->orderBy('total', 'desc')
            ->get(['publicacoes.codigo', 'publicacoes.titulo', DB::raw('count(publicacoes.id) as total')]);
    }

    private function getAlunosComMaisEmprestimos()
    {
        return $this->user
            ->join('alunos', 'alunos.user_id', '=', 'pessoas.id')
            ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->groupBy('emprestimos.user_id')
            ->orderBy('total', 'desc')
            ->orderBy('pessoas.nome', 'asc')
            ->get(['alunos.matricula', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', DB::raw('count(emprestimos.user_id) as total')]);
    }

    private function getFuncionariosComMaisEmprestimos()
    {
        return $this->user
            ->join('funcionarios', 'funcionarios.user_id', '=', 'pessoas.id')
            ->join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->groupBy('emprestimos.user_id')
            ->orderBy('total', 'desc')
            ->orderBy('pessoas.nome', 'asc')
            ->get(['funcionarios.num_registro', 'pessoas.nome', 'pessoas.telefone', 'pessoas.telefone2', 'pessoas.email', DB::raw('count(emprestimos.user_id) as total')]);
    }
}
