<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = 'turmas';

    protected $fillable = ['serie', 'turno', 'ano', 'ensino', 'letra_turma'];

    public $timestamps = false;

    /**
     *  Relacionamento 1 x N com publicação
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}
