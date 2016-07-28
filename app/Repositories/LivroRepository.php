<?php

namespace App\Repositories;

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

    public function store($data)
    {
        // Persistindo dados da request na publicação
        $this->publicacao->descricao = $data['descricao'];
        $this->publicacao->titulo = $data['titulo'];
        $this->publicacao->edicao = $data['edicao'];
        $this->publicacao->origem = $data['origem'];
        $this->publicacao->editora_id = $data['editora'];
        $this->publicacao->save();

        //Persistindo dados da request no livro
        $this->livro->subtitulo = $data['subtitulo'];
        $this->livro->isbn = $data['isbn'];
        $this->livro->cdu = $data['cdu'];
        $this->livro->cdd = $data['cdd'];
        $this->livro->ano = $data['ano'];
        $this->livro->autor_id = $data['autor'];
        $this->publicacao->livro()->save($this->livro);

        return $this->publicacao;
    }

    public function edit(){
        return [
            'autores'=> $this->autor->all(),
            'editoras'=> $this->editora->all()
        ];
    }

    public function update($data, $id)
    {
        $this->publicacao = $this->publicacao->find($id);

        // Atualizando dados da request na publicação
        $this->publicacao->descricao = $data['descricao'];
        $this->publicacao->titulo = $data['titulo'];
        $this->publicacao->edicao = $data['edicao'];
        $this->publicacao->origem = $data['origem'];
        $this->publicacao->editora_id = $data['editora'];

        //Atualizando dados da request no livro
        $this->publicacao->livro()->update([
            'subtitulo' => $data['subtitulo'],
            'isbn' => $data['isbn'],
            'cdu' => $data['cdu'],
            'cdd' => $data['cdd'],
            'ano' => $data['ano'],
            'autor_id' => $data['autor']
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
        return $this->livro->find($id);
    }
}