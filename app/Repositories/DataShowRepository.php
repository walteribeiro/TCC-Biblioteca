<?php

namespace App\Repositories;

use App\Http\Requests\DataShowRequest;
use App\Models\DataShow;

class DataShowRepository
{
    protected $dataShow;

    public function __construct(DataShow $dataShow)
    {
        $this->dataShow = $dataShow;
    }

    public function index()
    {
        return $this->dataShow->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store(DataShowRequest $dataShowRequest)
    {
        return $this->dataShow->create($dataShowRequest->all());
    }

    public function update(DataShowRequest $editoraRequest, $id)
    {
        $dataShow = $this->editora->find($id);
        $dataShow->nome = $editoraRequest->input('nome');
        $dataShow->save();

        return $dataShow;
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