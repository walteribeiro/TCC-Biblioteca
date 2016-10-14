<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataShow extends Model
{
    protected $table = 'data_shows';

    public $primaryKey = 'recurso_id';

    protected $fillable = ['marca, codigo'];

    public $timestamps = false;

    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }
}
