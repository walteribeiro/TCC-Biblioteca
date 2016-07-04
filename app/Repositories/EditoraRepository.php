<?php

namespace App\Repositories;


use App\Http\Requests\EditoraRequest;
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

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store(EditoraRequest $editoraRequest)
    {
        return $this->editora->create($editoraRequest->all());
    }

    public function update(EditoraRequest $editoraRequest, $id)
    {
        $editora = $this->editora->find($id);
        $editora->nome = $editoraRequest->input('nome');
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