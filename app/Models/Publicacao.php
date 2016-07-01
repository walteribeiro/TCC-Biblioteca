<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    protected $fillable = [
        'descricao','titulo','edicao','origem'
    ];
    //
}
