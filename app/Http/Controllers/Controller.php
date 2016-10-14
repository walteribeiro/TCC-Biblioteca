<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    const SUCESSO = 'sucesso';
    const ERRO = 'erro';
    const ERRO_VINCULAR = 'erro_vincular';
    const ALERTA = 'alerta';
    const INCLUSAO = 'Registro incluído com sucesso!';
    const EXCLUSAO = 'Registro removido com sucesso!';
    const ALTERACAO = 'Registro alterado com sucesso!';
    const ERRO_REFERENCIAMENTO = 'Este registro não pode ser removido, pois está sendo utilizado!';
    const ERRO_EXCLUSAO_TURMA = 'Para excluir a turma é necessário primeiro excluir os alunos!';
    const ERRO_MATRICULA_DUPLICADA = 'O número da matricula já se encontra utilizado!';
    const ERRO_DATA_SHOW_DUPLICADO = 'O código do data show já se encontra utilizado!';
    const ERRO_MAPA_DUPLICADO = 'O número do mapa já se encontra utilizado!';
    const ERRO_ALUNO_DUPLICADO_TURMA = 'Um ou mais dos alunos selecionados já se encontram na turma!';
    const ALERTA_SEM_PERMISSAO = 'Você não possui permissão!';


    public static function getTipoSucesso()
    {
        return self::SUCESSO;
    }

    public static function getTipoErro()
    {
        return self::ERRO;
    }

    public static function getTipoErroVincular()
    {
        return self::ERRO_VINCULAR;
    }

    public static function getMsgInclusao()
    {
        return self::INCLUSAO;
    }

    public static function getMsgExclusao()
    {
        return self::EXCLUSAO;
    }

    public static function getMsgAlteracao()
    {
        return self::ALTERACAO;
    }

    public static function getMsgErroReferenciamento()
    {
        return self::ERRO_REFERENCIAMENTO;
    }

    public static function getMsgErroExclusaoTurma()
    {
        return self::ERRO_EXCLUSAO_TURMA;
    }

    public static function getMsgErroMatriculaDuplicada()
    {
        return self::ERRO_MATRICULA_DUPLICADA;
    }

    public static function getMsgErroCodigoDataShowDuplicado()
    {
        return self::ERRO_DATA_SHOW_DUPLICADO;
    }

    public static function getMsgErroMapaDuplicado()
    {
        return self::ERRO_MAPA_DUPLICADO;
    }

    public static function getMsgErroAlunoDuplicadoTurma()
    {
        return self::ERRO_ALUNO_DUPLICADO_TURMA;
    }

    public static function getTipoSemPermission()
    {
        return self::ALERTA;
    }

    public static function getMsgSemPermission()
    {
        return self::ALERTA_SEM_PERMISSAO;
    }

    public function returnHomePage()
    {
        Session::flash(self::getTipoSemPermission(), self::getMsgSemPermission());
        return redirect()->route("home.index");
    }
}
