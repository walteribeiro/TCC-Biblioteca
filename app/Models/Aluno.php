<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';

    public $primaryKey = 'user_id';

    protected $fillable = ['matricula'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'alunos_turmas');
    }
}
