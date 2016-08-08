<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapa extends Model
{
    protected $table = 'mapas';

    protected $fillable = ['numero, titulo'];

    public $timestamps = false;

    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }
}
