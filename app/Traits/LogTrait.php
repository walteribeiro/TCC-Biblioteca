<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Monolog\Formatter\LineFormatter;
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
        // Verifica a existencia do arquivo, se não existir cria
        $this->verificarArquivo();

        // Verifica se existe algum arquivo com mais de 60 dias de criação e o exclui
        $this->excluirArquivo();

        $level = $this->getLevel($level);

        $this->dispararMensagem($mensagem, $level, $options);
    }

    /**
     * Verifica se o arquivo de LOG do dia já existe, caso não exista ele é criado.
     */
    private function verificarArquivo()
    {
        if (!file_exists(storage_path("logs/laravel-".date('Y-m-d').".log"))){
            $this->dispararMensagem("Início do arquivo", LogLevel::NOTICE);
        }
    }

    /**
     * Exclui os arquivos de log armazenados a mais de 60 dias
     */
    private function excluirArquivo(){
        $dataAtual = new \DateTime(date('Y-m-d'));
        $arquivos = array_diff(scandir(storage_path("logs")), array('..', '.', '.gitignore', 'laravel.log'));

        foreach ($arquivos as $key => $value)
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

    /**
     * Escreve no arquivo de log a transação ocorrida com o usuário que executou.
     * @param $mensagem
     * @param null $level
     * @param array $options
     */
    private function dispararMensagem($mensagem, $level = null, $options = [])
    {
        $log = new Logger("local");
        $handler = new StreamHandler(storage_path("logs/laravel-".date('Y-m-d').".log"), Logger::class, false);
        $handler->setFormatter(new LineFormatter(null, null, false, true));
        $log->pushHandler($handler);

        if(Auth::check()){
            $options["Usuário"] = Auth::user()->nome;
        }
        $log->log($level, $mensagem, $options);
    }
}