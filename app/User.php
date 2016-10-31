<?php

namespace App;

use App\Models\Aluno;
use App\Models\Emprestimo;
use App\Models\Funcionario;
use App\Models\Reserva;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'pessoas';

    protected $fillable = ['nome', 'username', 'password', 'telefone', 'telefone2', 'email', 'ativo'];

    protected $hidden = ['password', 'remember_token'];

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class);
    }

    public function aluno()
    {
        return $this->hasOne(Aluno::class, 'user_id');
    }

    public function emprestimos(){
        return $this->hasMany(Emprestimo::class);
    }

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

    public function hasPermission()
    {
        return $this->tipo_acesso === 0;
    }
}
