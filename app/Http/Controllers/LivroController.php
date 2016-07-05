<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Repositories\LivroRepository;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $livros = $this->repository->create();
        return view('livro.create', compact('livros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivroRequest $livroRequest)
    {
        $retorno = $this->repository->store($livroRequest);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('livro.index');
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->repository->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro = $this->repository->findById($id);
        $livros = $this->repository->edit();
        return view('livro.edit', compact('livro'), compact('livros'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LivroRequest $livroRequest, $id)
    {
        $retorno = $this->repository->update($livroRequest,$id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('livro.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
