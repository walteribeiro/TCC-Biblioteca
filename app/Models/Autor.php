<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';

    protected $fillable = ['nome', 'sobrenome'];

    public $timestamps = false;

    /**
     *  Relacionamento 1 x N com livro
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function livros()
    {
        return $this->hasMany(Livro::class);
    }

}
