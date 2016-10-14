<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Publicacao;
use Arcanedev\LogViewer\LogViewer;
use App\Http\Requests;

class ApiGraphController extends Controller
{
    protected $logViewer;
    protected $publicacao;

    public function __construct(LogViewer $logViewer, Publicacao $publicacao)
    {
        $this->logViewer = $logViewer;
        $this->publicacao = $publicacao;
    }

    public function sumarizarLogs()
    {
        return $this->logViewer->stats();
    }

    public function emprestimosEfetuados()
    {
        return $this->publicacao->join('editoras', 'editoras.id', '=', 'publicacoes.editora_id')->where('status', 2)->get(['codigo', 'editoras.nome'])->toJson();
    }
}
