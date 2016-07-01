<?php

namespace App\Repositories;


use App\Models\Editora;
use App\Repositories\Contracts\IEditoraRepository;

class EditoraRepository implements IEditoraRepository
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