<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';

    public $primaryKey = 'recurso_id';

    protected $fillable = ['tipo'];

    public $timestamps = false;

    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }
}
