<?php

namespace App\Repositories;

use App\Models\Sala;
use App\Models\Recurso;

class SalaRepository
{
    protected $sala;
    protected $recurso;

    public function __construct(Sala $sala, Recurso $recurso)
    {
        $this->sala = $sala;
        $this->recurso = $recurso;
    }

    public function index()
    {
        return $this->sala->all();
    }

    public function store($data)
    {
        // Persistindo dados da request no recurso
        $this->recurso->descricao = $data['descricao'];
        $this->recurso->save();

        //Persistindo dados da request no sala
        $this->sala->tipo = $data['tipo_sala'];
        $this->recurso->sala()->save($this->sala);

        return $this->recurso;
    }

    public function update($data, $id)
    {
        $this->recurso = $this->recurso->find($id);

        // Atualizando dados da request no recurso
        $this->recurso->descricao = $data['descricao'];

        //Atualizando dados da request no sala
        $this->recurso->sala()->update([
            'tipo' => $data['tipo_sala']
        ]);

        $this->recurso->save();

        return $this->recurso;
    }

    public function destroy($id)
    {
        return $this->recurso->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->sala->find($id);
    }
}