<?php

namespace App\Http\Controllers;

use Arcanedev\LogViewer\LogViewer;
use App\Http\Requests;

class ApiGraphController extends Controller
{
    protected $logViewer;

    public function __construct(LogViewer $logViewer)
    {
        $this->logViewer = $logViewer;
    }

    public function sumarizarLogs()
    {
        return $this->logViewer->stats();
    }
}
