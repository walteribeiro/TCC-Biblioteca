<?php

namespace App;

use App\Models\Aluno;
use App\Models\Funcionario;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'pessoas';

    protected $fillable = ['nome', 'username', 'password', 'telefone', 'telefone2', 'email', 'ativo'];

    protected $hidden = ['password', 'remember_token', 'tipo_acesso'];

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class);
    }

    public function aluno()
    {
        return $this->hasOne(Aluno::class, 'user_id');
    }
}
