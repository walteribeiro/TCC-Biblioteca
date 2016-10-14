<?php

namespace App\Repositories;

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

    public function store($data)
    {
        // Persistindo dados da request no recurso
        $this->recurso->descricao = $data['descricao'];
        $this->recurso->save();

        //Persistindo dados da request no dataShow
        $this->dataShow->marca = $data['marca'];
        $this->dataShow->codigo = $data['codigo'];
        $this->recurso->dataShow()->save($this->dataShow);

        return $this->recurso;
    }

    public function update($data, $id)
    {
        $this->recurso = $this->recurso->find($id);

        // Atualizando dados da request no recurso
        $this->recurso->descricao = $data['descricao'];

        //Atualizando dados da request no dataShow
        $this->recurso->dataShow()->update([
            'marca' => $data['marca'],
            'codigo' => $data['codigo']
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
        return $this->dataShow->find($id);
    }

    public function countDataShows($id, $codigo){
        return $this->dataShow->where([['codigo', '=', $codigo], ['recurso_id', '<>', $id]])->count();
    }
}