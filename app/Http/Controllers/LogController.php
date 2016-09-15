<?php

namespace App\Http\Controllers;

use Arcanedev\LogViewer\Exceptions\LogNotFound;
use Arcanedev\LogViewer\Http\Controllers\LogViewerController;
use App\Http\Requests;

class LogController extends LogViewerController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return parent::index();
    }

    public function listLogs()
    {
        return parent::listLogs();
    }

    public function show($date)
    {
        return parent::show($date);
    }

    public function download($date)
    {
        return parent::download($date);
    }

    public function showByLevel($date, $level)
    {
        $log = $this->getSpecificLogOrFail($date);

        if ($level == 'all') {
            return redirect()->route('log.show', [$date]);
        }

        $levels  = $this->logViewer->levelsNames();
        $entries = $this->logViewer
            ->entries($date, $level)
            ->paginate($this->perPage);

        return $this->view('show', compact('log', 'levels', 'entries'));
    }

    public function delete()
    {
        return parent::delete();
    }

    private function getSpecificLogOrFail($date)
    {
        $log = null;

        try {
            $log = $this->logViewer->get($date);
        }
        catch(LogNotFound $e) {
            abort(404, $e->getMessage());
        }

        return $log;
    }
}
