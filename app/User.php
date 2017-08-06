<?php

namespace App;

use App\Models\Emprestimo;
use App\Models\Reserva;
use App\Models\ReservaRecurso;
use App\Models\Turma;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'pessoas';

    protected $fillable = ['nome', 'username', 'password', 'telefone', 'telefone2', 'email', 'matricula', 'ativo', 'tipo_pessoa'];

    protected $hidden = ['password', 'remember_token'];


    public function emprestimos(){
        return $this->hasMany(Emprestimo::class);
    }

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'alunos_turmas');
    }

    public function reservaRecurso(){
        return $this->hasMany(ReservaRecurso::class);
    }

    public function hasPermission()
    {
        return $this->tipo_acesso === 4;
    }
}
