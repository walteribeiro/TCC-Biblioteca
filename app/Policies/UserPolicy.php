<?php

namespace App\Policies;

use App\Models\Funcionario;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user, User $usuario)
    {
        return $user->tipo_acesso === 0;
    }
}
