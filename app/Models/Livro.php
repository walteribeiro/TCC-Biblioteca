<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livros';

    protected $fillable = ['subtitulo', 'isbn', 'cdu', 'cdd', 'ano'];

    public $timestamps = false;

    /**
     *  Relacionamento 1 x 1 com publicação
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publicacao(){
        return $this->belongsTo(Publicacao::class);
    }

    /**
     *  Relacionamento 1 x N com autor
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

}
