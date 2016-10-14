<?php

namespace App\Traits;

use App\User;

trait EfetuaEmprestimoReservaTrait
{
    public function efetuarEmprestimo(User $user)
    {
        if($user->tipo_acesso === 1){// Tipo acesso 0 significa que é o admin, 1 é funcionário e 2 aluno

            if($user->funcionario()->tipo_funcionario === 0){// Tipo 0 Geral, 1 é Professor e 2 Bibliotecário

            }

        }
    }

    public function efetuarEmprestimoRecurso()
    {

    }
}