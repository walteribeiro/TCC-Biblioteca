<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    protected $table = 'publicacoes';
    protected $fillable = [
        'descricao','titulo','edicao','origem'
    ];
    //

    public function livro(){
        return $this->hasOne(Livro::class);
    }

    public function editora(){
        return $this->belongsTo(Editora::class);
    }
}
