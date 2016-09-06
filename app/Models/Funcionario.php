<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';

    protected $fillable = ['num_registro', 'tipo_funcionario'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservaRecurso(){
      return $this->hasMany(ReservaRecurso::class);
    }
}
