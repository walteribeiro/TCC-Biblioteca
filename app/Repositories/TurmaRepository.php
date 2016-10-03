<?php

namespace App\Repositories;

use App\Models\Aluno;
use App\Models\Turma;

class TurmaRepository
{
    protected $turma;
    protected $aluno;

    public function __construct(Turma $turma, Aluno $aluno)
    {
        $this->turma = $turma;
        $this->aluno = $aluno;
    }

    public function index()
    {
        return $this->turma->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store($data)
    {
        $this->turma->serie = $data['serie'];
        $this->turma->turno = $data['turno'];
        $this->turma->ano = $data['ano'];
        $this->turma->ensino = $data['ensino'];
        $this->turma->letra_turma = $data['letraTurma'];
        $this->turma->save();

        return $this->turma;
    }

    public function update($data, $id)
    {
        $this->turma = $this->turma->find($id);

        $this->turma->update([
            'serie' => $data['serie'],
            'turno' => $data['turno'],
            'ano' => $data['ano'],
            'ensino' => $data['ensino'],
            'letra_turma' => $data['letraTurma'],
        ]);

        $this->turma->save();

        return $this->turma;
    }

    public function vincular($data)
    {
        $alunos_id = $data['aluno'];
        $turma_id = $data['id_turma'];

        $turma = $this->turma->find($turma_id);

        return $turma->alunos()->sync($alunos_id, false);
    }

    public function destroy($id)
    {
        return $this->turma->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->turma->find($id);
    }

    public function getAlunos()
    {
        return $this->aluno->all();
    }
}