<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = 'turmas';

    protected $fillable = ['serie', 'turno', 'ano', 'ensino', 'letra_turma'];

    public $timestamps = false;

    /**
     *  Relacionamento N x N com alunos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alunos()
    {
        return $this->belongsToMany(User::class, 'alunos_turmas');
    }
}
