<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'recursos';

    protected $fillable = ['descricao'];

    public function dataShow()
    {
        return $this->hasOne(DataShow::class, 'recurso_id');
    }

    public function mapa()
    {
        return $this->hasOne(Mapa::class, 'recurso_id');
    }

    public function sala()
    {
        return $this->hasOne(Sala::class, 'recurso_id');
    }

    public function reservaRecurso(){
        return $this->hasMany(ReservaRecurso::class);
    }
}
