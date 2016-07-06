<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
    protected $table = 'editoras';

    protected $fillable = ['nome'];

    public $timestamps = false;

    /**
     *  Relacionamento 1 x N com publicação
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publicacoes()
    {
        return $this->hasMany(Publicacao::class);
    }
}
