<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Publicacao;
use App\Models\Reserva;
use App\Models\ReservaRecurso;
use App\Models\Revista;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $livro;
    protected $emprestimo;
    protected $reservaRecurso;
    protected $aluno;
    protected $publicacao;
    protected $revista;
    protected $reserva;

    public function __construct(Livro $livro, Emprestimo $emprestimo, ReservaRecurso $reservaRecurso, Aluno $aluno,
                                Publicacao $publicacao, Revista $revista, Reserva $reserva)
    {
        $this->livro = $livro;
        $this->emprestimo = $emprestimo;
        $this->reservaRecurso = $reservaRecurso;
        $this->aluno = $aluno;
        $this->publicacao = $publicacao;
        $this->revista = $revista;
        $this->reserva = $reserva;
    }

    public function index()
    {
        $livros = $this->livro->all()->count();
        $emprestimos = $this->emprestimo->all()->count();
        $reservaRecurso = $this->reservaRecurso->all()->count();
        $alunos = $this->aluno->all()->count();
        $revistas = $this->revista->all()->count();
        $reservas = $this->reserva->all()->count();
        $publicacoes = $this->getPublicacoes();
        $pessoas = $this->getPessoas();
        $recursos = $this->getRecursos();
        return view('welcome', compact('livros', 'emprestimos', 'reservaRecurso', 'alunos', 'publicacoes', 'pessoas', 'recursos', 'revistas', 'reservas'));
    }

    private function getPublicacoes()
    {
        return $this->publicacao
            ->join('emprestimos_publicacoes', 'emprestimos_publicacoes.publicacao_id', '=', 'publicacoes.id')
            ->groupBy('publicacoes.id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get(['publicacoes.codigo', 'publicacoes.titulo', DB::raw('count(publicacoes.id) as total')]);
    }

    private function getPessoas()
    {
        return $this->emprestimo
            ->join('pessoas', 'pessoas.id', '=', 'emprestimos.user_id')
            ->groupBy(['emprestimos.user_id', 'pessoas.nome', 'pessoas.email'])
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get(['pessoas.nome', 'pessoas.email', DB::raw('count(emprestimos.user_id) as total')]);
    }

    private function getRecursos()
    {
        $totalReservaRecurso = $this->reservaRecurso->all()->count();
        return $this->reservaRecurso
            ->join('recursos', 'recursos.id', '=', 'reserva_recursos.recurso_id')
            ->groupBy(['reserva_recursos.recurso_id', 'recursos.descricao'])
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get(['recursos.descricao', DB::raw('count(reserva_recursos.recurso_id) as total'), DB::raw('(count(reserva_recursos.recurso_id) * 100) / '. $totalReservaRecurso .'  as percentage')]);
    }
}
