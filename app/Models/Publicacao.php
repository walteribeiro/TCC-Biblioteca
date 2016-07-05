<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    protected $table = 'publicacoes';

    protected $fillable = ['descricao', 'titulo', 'edicao', 'origem'];

    /**
     *  Relacionamento 1 x 1 com livro
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function livro(){
        return $this->hasOne(Livro::class);
    }

    /**
     *  Relacionamento 1 x N com editora
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editora(){
        return $this->belongsTo(Editora::class);
    }
}
