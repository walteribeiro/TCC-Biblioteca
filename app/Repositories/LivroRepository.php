<?php

namespace App\Repositories;


use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use App\Models\Publicacao;

class LivroRepository
{
    protected $livro;
    protected $publicacao;

    public function __construct(Livro $livro, Publicacao $publicacao)
    {
        $this->livro = $livro;
        $this->publicacao = $publicacao;
    }

    public function index()
    {
        $this->livro->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store(LivroRequest $livroRequest)
    {
        // Recebendo os atributos da classe pai pelo request
        $this->publicacao->descricao = $livroRequest->input('descricao');
        $this->publicacao->titulo = $livroRequest->input('titulo');
        $this->publicacao->edicao = $livroRequest->input('edicao');
        $this->publicacao->origem = $livroRequest->input('origem');
        $this->publicacao->save();

        $this->livro->subtitulo = $livroRequest->input('subtitulo');
        $this->livro->isbn = $livroRequest->input('isbn');
        $this->livro->cdu = $livroRequest->input('cdu');
        $this->livro->cdd = $livroRequest->input('cdd');
        $this->livro->ano = $livroRequest->input('ano');
        $this->publicacao->livro()->save($this->livro);

    }

    public function update(LivroRequest $livroRequest, $id)
    {
        $this->publicacao = $this->publicacao->find($id);

        // Recebendo os atributos da classe pai pelo request
        $this->publicacao->descricao = $livroRequest->input('descricao');
        $this->publicacao->titulo = $livroRequest->input('titulo');
        $this->publicacao->edicao = $livroRequest->input('edicao');
        $this->publicacao->origem = $livroRequest->input('origem');
        $this->publicacao->save();

        $this->livro->subtitulo = $livroRequest->input('subtitulo');
        $this->livro->isbn = $livroRequest->input('isbn');
        $this->livro->cdu = $livroRequest->input('cdu');
        $this->livro->cdd = $livroRequest->input('cdd');
        $this->livro->ano = $livroRequest->input('ano');

        $this->publicacao->livro()->save($this->livro);
    }


    public function destroy($id)
    {
        return $this->livro->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->livro->find($id);
    }
}