<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    const SUCESSO = 'sucesso';
    const ERRO = 'erro';
    const INCLUSAO = 'Registro incluído com sucesso!';
    const EXCLUSAO = 'Registro removido com sucesso!';
    const ALTERACAO = 'Registro alterado com sucesso!';
    const ERRO_REFERENCIAMENTO = 'Este registro não pode ser removido, pois está sendo referenciado!';


    public static function getTipoSucesso()
    {
        return self::SUCESSO;
    }

    public static function getTipoErro()
    {
        return self::ERRO;
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
}
