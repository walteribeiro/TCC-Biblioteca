<?php

namespace App\Repositories\Helpers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;

trait LogTrait
{
    /**
     * Tipos de LOGS 'level' disponíveis
     *
     * - emergencia
     * - alerta
     * - critico
     * - erro
     * - atencao
     * - noticia
     * - debug
     * --------------------------------
     * @param $mensagem
     * @param null $level
     * @param array|null $options
     */
    public function gravarLog($mensagem, $level = null, $options = [])
    {
        $this->verificarArquivo();
        $this->excluirArquivo();
        $level = $this->getLevel($level);
        $log = new Logger("local");
        $log->pushHandler(new StreamHandler(storage_path("logs/laravel-".date('Y-m-d').".log"), Logger::class, false));
        $log->log($level, $mensagem, $options);
    }

    /**
     * Verifica se o arquivo de LOG do dia já existe, caso não exista ele é criado.
     */
    private function verificarArquivo()
    {
        if (!file_exists(storage_path("logs/laravel-".date('Y-m-d').".log"))){
            $log = new Logger("local");
            $log->pushHandler(new StreamHandler(storage_path("logs/laravel-".date('Y-m-d').".log"), Logger::class, false));
            $log->addNotice("Inicio do arquivo", []);
        }
    }

    /**
     * Exclui os arquivos de log armazenados a mais de 60 dias
     */
    private function excluirArquivo(){
        $dataAtual = new \DateTime(date('Y-m-d'));
        $dn = array_diff(scandir(storage_path("logs")), array('..', '.', '.gitignore'));

        foreach ($dn as $key => $value)
        {
            $intervalo = $dataAtual->diff(new \DateTime(substr($value, 8, 10)));
            if ($intervalo->days > 60) {
                $deletar = storage_path("logs");
                unlink($deletar . "/" . $value);
            }
        }
    }

    /**
     * Retorna o tipo do LOG de acordo com o parãmetro informado, o 'info' é o padrão.
     * @param $logLevel
     * @return string
     */
    private function getLevel($logLevel){
        switch ($logLevel){
            case "emergencia":
                return LogLevel::EMERGENCY;
            case "alerta":
                return LogLevel::ALERT;
            case "critico":
                return LogLevel::CRITICAL;
            case "erro":
                return LogLevel::ERROR;
            case "atencao":
                return LogLevel::WARNING;
            case "noticia":
                return LogLevel::NOTICE;
            case "debug":
                return LogLevel::DEBUG;
            default:
                return LogLevel::INFO;
        }
    }
}