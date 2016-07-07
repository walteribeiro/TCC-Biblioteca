<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Repositories\LivroRepository;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class LivroController extends Controller
{

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
            return redirect()->route('livro.index');
        }
        return redirect()->back();

    }

    public function show($id)
    {
        $this->repository->show($id);
    }

    public function edit($id)
    {
        $publicacao = $this->repository->findById($id);
        $listAutoresEditoras = $this->repository->edit();
        return view('livro.edit', compact('publicacao', 'listAutoresEditoras'));
    }

    public function update(LivroRequest $livroRequest, $id)
    {
        $retorno = $this->repository->update($livroRequest,$id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('livro.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('livro.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
