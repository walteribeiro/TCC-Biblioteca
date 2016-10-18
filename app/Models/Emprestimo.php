<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $table = 'emprestimos';

    protected $fillable = ['data_devolucao', 'data_prevista', 'data_emprestimo', 'situacao'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function publicacoes(){
        return $this->belongsToMany(Publicacao::class, 'emprestimos_publicacoes');
    }

    public function getDataPrevistaAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function getDataDevolucaoAttribute($value)
    {
        if(is_null($value)){
            return "";
        }
        return date('d/m/Y', strtotime($value));
    }

    public function getDataEmprestimoAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
