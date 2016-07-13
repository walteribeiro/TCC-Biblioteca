<?php

namespace App\Repositories\Helpers;

use App\Models\User;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;

trait LogTrait
{

    public function gravarLog(User $user, $nome, $msg, LogLevel $level = null, array $options = null)
    {
        $log = new Logger($nome);
        $log->log((empty($level) ? LogLevel::INFO : $level), $msg . $user->name , (empty($options) ? [] : $options));
    }

    public function verificarArquivo()
    {
        if (!file_exists(storage_path("logs/laravel-".date('Y-m-d').".log"))){
            $log = new Logger("Inicio");
            $log->pushHandler(new StreamHandler(storage_path("logs/laravel-".date('Y-m-d').".log"), Logger::class, false));
            $log->log(Logger::NOTICE, "Inicio do arquivo", array());
        }
    }

}