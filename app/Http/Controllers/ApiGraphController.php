<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Arcanedev\LogViewer\LogViewer;
use App\Http\Requests;
use Carbon\Carbon;

class ApiGraphController extends Controller
{
    protected $logViewer;
    protected $emprestimo;

    public function __construct(LogViewer $logViewer, Emprestimo $emprestimo)
    {
        $this->logViewer = $logViewer;
        $this->emprestimo = $emprestimo;
    }

    public function sumarizarLogs()
    {
        return $this->logViewer->stats();
    }

    public function emprestimosAtrasados()
    {
        return $this->emprestimo->join('pessoas', 'pessoas.id', '=', 'emprestimos.user_id')->where([['data_devolucao', null], ['data_prevista', '<=', Carbon::today()]])->get(['pessoas.nome', 'emprestimos.data_emprestimo']);
    }
}
