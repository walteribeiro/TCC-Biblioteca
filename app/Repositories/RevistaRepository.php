<?php

namespace App\Repositories;


use App\Http\Requests\RevistaRequest;
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

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function create(){
        return [
            'editoras'=> $this->editora->all()
        ];
    }

    public function store(RevistaRequest $revistaRequest)
    {
        // Persistindo dados da request na publicação
        $this->publicacao->descricao = $revistaRequest->input('descricao');
        $this->publicacao->titulo = $revistaRequest->input('titulo');
        $this->publicacao->edicao = $revistaRequest->input('edicao');
        $this->publicacao->origem = $revistaRequest->input('origem');
        $this->publicacao->editora_id = $revistaRequest->input('editora');
        $this->publicacao->save();

        //Persistindo dados da request no revista
        $this->revista->referencia = $revistaRequest->input('referencia');
        $this->revista->categoria = $revistaRequest->input('categoria');
        $this->publicacao->revista()->save($this->revista);

        return $this->publicacao;

    }

    public function edit(){
        return [
            'editoras'=> $this->editora->all()
        ];
    }

    public function update(RevistaRequest $revistaRequest, $id)
    {
        $this->publicacao = $this->publicacao->find($id);

        // Atualizando dados da request na publicação
        $this->publicacao->descricao = $revistaRequest->input('descricao');
        $this->publicacao->titulo = $revistaRequest->input('titulo');
        $this->publicacao->edicao = $revistaRequest->input('edicao');
        $this->publicacao->origem = $revistaRequest->input('origem');
        $this->publicacao->editora_id = $revistaRequest->input('editora');

        //Atualizando dados da request no revista
        $this->publicacao->revista()->update([
            'referencia' => $revistaRequest->input('referencia'),
            'categoria' => $revistaRequest->input('categoria'),
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
        return $this->publicacao->find($id);
    }
}