<?php

namespace App\Repositories;


use App\Http\Requests\LivroRequest;
use App\Models\Autor;
use App\Models\Editora;
use App\Models\Livro;
use App\Models\Publicacao;

class LivroRepository
{
    protected $livro;
    protected $publicacao;
    protected $autor;
    protected $editora;

    public function __construct(Livro $livro, Publicacao $publicacao, Autor $autor, Editora $editora)
    {
        $this->livro = $livro;
        $this->publicacao = $publicacao;
        $this->autor = $autor;
        $this->editora = $editora;
    }

    public function index()
    {
        return $this->livro->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function create(){
        return [
            'autores'=> $this->autor->all(),
            'editoras'=> $this->editora->all()
        ];
    }

    public function store(LivroRequest $livroRequest)
    {
        // Persistindo dados da request na publicação
        $this->publicacao->descricao = $livroRequest->input('descricao');
        $this->publicacao->titulo = $livroRequest->input('titulo');
        $this->publicacao->edicao = $livroRequest->input('edicao');
        $this->publicacao->origem = $livroRequest->input('origem');
        $this->publicacao->editora_id = $livroRequest->input('editora');
        $this->publicacao->save();

        //Persistindo dados da request no livro
        $this->livro->subtitulo = $livroRequest->input('subtitulo');
        $this->livro->isbn = $livroRequest->input('isbn');
        $this->livro->cdu = $livroRequest->input('cdu');
        $this->livro->cdd = $livroRequest->input('cdd');
        $this->livro->ano = $livroRequest->input('ano');
        $this->livro->autor_id = $livroRequest->input('autor');
        $this->publicacao->livro()->save($this->livro);

        return $this->publicacao;

    }

    public function edit(){
        return [
            'autores'=> $this->autor->all(),
            'editoras'=> $this->editora->all()
        ];
    }

    public function update(LivroRequest $livroRequest, $id)
    {
        $this->publicacao = $this->publicacao->find($id);

        // Atualizando dados da request na publicação
        $this->publicacao->descricao = $livroRequest->input('descricao');
        $this->publicacao->titulo = $livroRequest->input('titulo');
        $this->publicacao->edicao = $livroRequest->input('edicao');
        $this->publicacao->origem = $livroRequest->input('origem');
        $this->publicacao->editora_id = $livroRequest->input('editora');

        //Atualizando dados da request no livro
        $this->publicacao->livro()->update([
            'subtitulo' => $livroRequest->input('subtitulo'),
            'isbn' => $livroRequest->input('isbn'),
            'cdu' => $livroRequest->input('cdu'),
            'cdd' => $livroRequest->input('cdd'),
            'ano' => $livroRequest->input('ano'),
            'autor_id' => $livroRequest->input('autor'),
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