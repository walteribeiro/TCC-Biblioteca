<?php

namespace App\Models;

use App\Models\Funcionario;
use App\Models\Recurso;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ReservaRecurso extends Model
{
    protected $table = 'reserva_recursos';

    protected $fillable = ['aula', 'data_reserva'];

    public function funcionario(){
        return $this -> belongsTo(User::class);
    }
    public function recurso(){
        return $this -> belongsTo(Recurso::class);
    }
}
