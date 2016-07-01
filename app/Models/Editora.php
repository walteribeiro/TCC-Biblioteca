<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
    protected $fillable = [
      'nome'
    ];
    public $timestamps = false;
    //

    public function publicacoes(){
        return $this->hasMany(Publicacao::class);
    }
}
