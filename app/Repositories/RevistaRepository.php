<?php

namespace App\Repositories;

use App\Models\Editora;
use App\Models\Revista;
use App\Models\Publicacao;

class RevistaRepository
{
    protected $revista;
    protected $publicacao;
    protected $editora;

    public function __construct(Revista $revista, Publicacao $publicacao, Editora $editora)
    {
        $this->revista = $revista;
        $this->publicacao = $publicacao;
        $this->editora = $editora;
    }

    public function index()
    {
        return $this->revista->all();
    }

    public function create(){
        return [
            'editoras'=> $this->editora->all()
        ];
    }

    public function store($data)
    {
        $status = $data['status'];

        // Persistindo dados da request na publicação
        $this->publicacao->codigo = $data['codigo'];
        $this->publicacao->status = ($status != null ? 0 : 1);
        $this->publicacao->descricao = $data['descricao'];
        $this->publicacao->titulo = $data['titulo'];
        $this->publicacao->edicao = $data['edicao'];
        $this->publicacao->origem = $data['origem'];
        $this->publicacao->editora_id = $data['editora'];
        $this->publicacao->save();

        //Persistindo dados da request no revista
        $this->revista->referencia = $data['referencia'];
        $this->revista->categoria = $data['categoria'];
        $this->publicacao->revista()->save($this->revista);

        return $this->publicacao;

    }

    public function edit(){
        return [
            'editoras'=> $this->editora->all()
        ];
    }

    public function update($data, $id)
    {
        $this->publicacao = $this->publicacao->find($id);

        $status = $data['status'];

        // Atualizando dados da request na publicação
        $this->publicacao->codigo = $data['codigo'];
        $this->publicacao->status = ($status != null ? 0 : 1);
        $this->publicacao->descricao = $data['descricao'];
        $this->publicacao->titulo = $data['titulo'];
        $this->publicacao->edicao = $data['edicao'];
        $this->publicacao->origem = $data['origem'];
        $this->publicacao->editora_id = $data['editora'];

        //Atualizando dados da request no revista
        $this->publicacao->revista()->update([
            'referencia' => $data['referencia'],
            'categoria' => $data['categoria']
        ]);

        $this->publicacao->save();

        return $this->publicacao;
    }

    public function destroy($id)
    {
        return $this->publicacao->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->revista->find($id);
    }
}