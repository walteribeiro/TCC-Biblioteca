<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'recursos';

    protected $fillable = ['descricao'];

    /**
     *  Relacionamento 1 x 1 com livro
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dataShow()
    {
        return $this->hasOne(DataShow::class);
    }
    //
}
