<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Publicacao
{
    public function publicacao(){
        return $this->belongsTo(Publicacao::class);
    }
}
