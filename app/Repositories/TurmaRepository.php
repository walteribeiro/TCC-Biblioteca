<?php

namespace App\Repositories;

use App\Models\Turma;

class TurmaRepository
{
    protected $turma;

    public function __construct(Turma $turma)
    {
        $this->turma = $turma;
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

        $this->turma->turma->save();

        return $this->turma;
    }

    public function destroy($id)
    {
        return $this->turma->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->turma->find($id);
    }
}