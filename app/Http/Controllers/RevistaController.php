<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevistaRequest;
use App\Http\Requests;
use App\Repositories\RevistaRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class RevistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $repository;

    public function __construct(RevistaRepository $revistaRepository)
    {
        $this->repository = $revistaRepository;

    }

    public function index()
    {
        $revistas = $this->repository->index();
        return view('revista.index', compact('revistas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $revistas = $this->repository->create();
        return view('revista.create', compact('revistas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RevistaRequest $revistaRequest)
    {
        $retorno = $this->repository->store($revistaRequest);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('revista.index');
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
        $revista = $this->repository->findById($id);
        $listEditoras = $this->repository->edit();
        return view('revista.edit', compact('revista', 'listEditoras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RevistaRequest $revistaRequest, $id)
    {
        $retorno = $this->repository->update($revistaRequest,$id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('revista.index');
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
            return redirect()->route('revista.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
