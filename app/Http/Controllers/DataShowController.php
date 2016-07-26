<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataShowRequest;
use App\Repositories\DataShowRepository;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class DataShowController extends Controller
{

    protected $repository;

    public function __construct(DataShowRepository $dataShowRepository)
    {
        $this->repository = $dataShowRepository;
        $this->middleware('auth');

    }

    public function index()
    {
        $dataShows = $this->repository->index();
        return view('data-show.index', compact('dataShows'));
    }

    public function create()
    {
        return view('data-show.create');
    }

    public function store(DataShowRequest $dataShowRequest)
    {
        $retorno = $this->repository->store($dataShowRequest);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            return redirect()->route('data-show.index');
        }
        return redirect()->back();

    }

    public function show($id)
    {
        $this->repository->show($id);
    }

    public function edit($id)
    {
        $recurso = $this->repository->findById($id);
        return view('data-show.edit', compact('recurso'));
    }

    public function update(DataShowRequest $dataShowRequest, $id)
    {
        $retorno = $this->repository->update($dataShowRequest,$id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            return redirect()->route('data-show.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            return redirect()->route('data-show.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }
}
