<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        'subtitulo','isbn','cdu','cdd','ano'
    ];

    public function publicacao(){
        return $this->belongsTo(Publicacao::class);
    }

    public $timestamps = false;
}
