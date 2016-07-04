<?php

namespace App\Repositories;

use App\Http\Requests\AutorRequest;
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

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store(AutorRequest $autorRequest)
    {
        return $this->autor->create($autorRequest->all());
    }

    public function update(AutorRequest $autorRequest, $id)
    {
        $autor = $this->autor->find($id);
        $autor->nome = $autorRequest->input('nome');
        $autor->sobrenome = $autorRequest->input('sobrenome');
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