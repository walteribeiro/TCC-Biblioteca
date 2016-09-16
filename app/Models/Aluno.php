<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';

    protected $fillable = ['matricula', 'turma'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //
}
