<?php

namespace App\Repositories;


use App\Http\Requests\DataShowRequest;
use App\Models\Autor;
use App\Models\Editora;
use App\Models\DataShow;
use App\Models\Recurso;

class DataShowRepository
{
    protected $dataShow;
    protected $recurso;

    public function __construct(DataShow $dataShow, Recurso $recurso)
    {
        $this->dataShow = $dataShow;
        $this->recurso = $recurso;
    }

    public function index()
    {
        return $this->dataShow->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function create(){

    }

    public function store(DataShowRequest $dataShowRequest)
    {
        // Persistindo dados da request no recurso
        $this->recurso->descricao = $dataShowRequest->input('descricao');
        $this->recurso->save();

        //Persistindo dados da request no dataShow
        $this->dataShow->marca = $dataShowRequest->input('marca');
        $this->dataShow->codigo = $dataShowRequest->input('codigo');
        $this->recurso->dataShow()->save($this->dataShow);

        return $this->recurso;

    }

    public function edit(){

    }

    public function update(DataShowRequest $dataShowRequest, $id)
    {
        $this->recurso = $this->recurso->find($id);

        // Atualizando dados da request no recurso
        $this->recurso->descricao = $dataShowRequest->input('descricao');

        //Atualizando dados da request no dataShow
        $this->recurso->dataShow()->update([
            'marca' => $dataShowRequest->input('marca'),
            'codigo' => $dataShowRequest->input('codigo'),
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
        return $this->recurso->find($id);
    }
}