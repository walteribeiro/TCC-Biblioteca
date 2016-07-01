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
        Editora::create($editoraRequest->all());
    }

    public function update(EditoraRequest $editoraRequest, $id)
    {
        $editora = Editora::find($id);
        $editora->nome = $editoraRequest->input('nome');

        $editora->save();
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}