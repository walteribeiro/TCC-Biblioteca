<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Repositories\LivroRepository;
use App\Http\Requests;
use App\Traits\LogTrait;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class LivroController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(LivroRepository $livroRepository)
    {
        $this->repository = $livroRepository;
    }

    public function index()
    {
        $livros = $this->repository->index();
        return view('livro.index', compact('livros'));
    }

    public function create()
    {
        $livros = $this->repository->create();
        return view('livro.create', compact('livros'));
    }

    public function store(LivroRequest $livroRequest)
    {
        $retorno = $this->repository->store($livroRequest);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Livro adicionado!", "informacao", ["Livro" => $retorno->titulo]);
            return redirect()->route('livro.index');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $livro = $this->repository->findById($id);
        $listAutoresEditoras = $this->repository->edit();
        return view('livro.edit', compact('livro', 'listAutoresEditoras'));
    }

    public function update(LivroRequest $livroRequest, $id)
    {
        $retorno = $this->repository->update($livroRequest, $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Livro alterado!", "atencao", ["Livro" => $retorno->titulo]);
            return redirect()->route('livro.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Livro excluído!", "alerta");
            return redirect()->route('livro.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
