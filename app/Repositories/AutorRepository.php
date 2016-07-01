<?php

namespace App\Repositories;


use App\Http\Requests\AutorRequest;
use App\Models\Autor;

class AutorRepository
{
    protected $autor;

    public function __construct(Autor $autor)
    {
        $this->editora = $autor;
    }

    public function index()
    {
        return $this->editora->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store(AutorRequest $autorRequest)
    {
        Autor::create($autorRequest->all());
    }

    public function update(AutorRequest $autorRequest, $id)
    {
        $autor = Autor::find($id);
        $autor->nome = $autorRequest->input('nome');

        $autor->save();
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