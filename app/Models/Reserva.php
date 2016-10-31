<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = ['data_limite', 'data_reserva', 'situacao'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function publicacao(){
        return $this->belongsTo(Publicacao::class);
    }

    public function getDataLimiteAttribute($value)
    {
        if(is_null($value)){
            return "";
        }
        return date('d/m/Y', strtotime($value));
    }

    public function getDataReservaAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
