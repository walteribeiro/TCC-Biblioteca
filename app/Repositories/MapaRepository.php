<?php

namespace App\Repositories;

use App\Models\Mapa;
use App\Models\Recurso;

class MapaRepository
{
    protected $mapa;
    protected $recurso;

    public function __construct(Mapa $mapa, Recurso $recurso)
    {
        $this->mapa = $mapa;
        $this->recurso = $recurso;
    }

    public function index()
    {
        return $this->mapa->all();
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

        //Persistindo dados da request no mapa
        $this->mapa->numero = $data['numero'];
        $this->mapa->titulo = $data['titulo'];
        $this->recurso->mapa()->save($this->mapa);

        return $this->recurso;
    }

    public function update($data, $id)
    {
        $this->recurso = $this->recurso->find($id);

        // Atualizando dados da request no recurso
        $this->recurso->descricao = $data['descricao'];

        //Atualizando dados da request no mapa
        $this->recurso->mapa()->update([
            'numero' => $data['numero'],
            'titulo' => $data['titulo']
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
        return $this->mapa->find($id);
    }
}