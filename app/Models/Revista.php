<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revista extends Model
{
    protected $table = 'revistas';

    public $primaryKey = 'publicacao_id';

    protected $fillable = ['referencia','categoria'];

    public $timestamps = false;

    /**
     *  Relacionamento 1 x 1 com publicação
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class);
    }

}
