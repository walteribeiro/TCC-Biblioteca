<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'recursos';

    protected $fillable = ['descricao'];

    public function dataShow()
    {
        return $this->hasOne(DataShow::class);
    }

    public function mapa()
    {
        return $this->hasOne(Mapa::class);
    }

    public function sala()
    {
        return $this->hasOne(Sala::class);
    }
}
