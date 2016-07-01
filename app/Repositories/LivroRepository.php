<?php

namespace App\Repositories;


use App\Models\Livro;

class LivroRepository
{
    protected $livro;

    public function __construct(Livro $livro)
    {
        $this->livro = $livro;
    }

    public function index()
    {
        $this->livro->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}