<?php

namespace App\Repositories;

use App\Models\Autor;

class AutorRepository
{
    protected $autor;

    public function __construct(Autor $autor)
    {
        $this->autor = $autor;
    }

    public function index()
    {
        return $this->autor->all();
    }

    public function store($data)
    {
        return $this->autor->create($data);
    }

    public function update($data, $id)
    {
        $autor = $this->autor->find($id);
        $autor->nome = $data['nome'];
        $autor->sobrenome = $data['sobrenome'];
        $autor->save();

        return $autor;
    }

    public function destroy($id)
    {
        return $this->autor->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->autor->find($id);
    }
}