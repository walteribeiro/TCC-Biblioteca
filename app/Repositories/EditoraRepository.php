<?php

namespace App\Repositories;

use App\Models\Editora;

class EditoraRepository
{
    protected $editora;

    public function __construct(Editora $editora)
    {
        $this->editora = $editora;
    }

    public function index()
    {
        return $this->editora->all();
    }

    public function store($data)
    {
        return $this->editora->create($data);
    }

    public function update($data, $id)
    {
        $editora = $this->editora->find($id);
        $editora->nome = $data['nome'];
        $editora->save();

        return $editora;
    }

    public function destroy($id)
    {
        return $this->editora->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->editora->find($id);
    }
}