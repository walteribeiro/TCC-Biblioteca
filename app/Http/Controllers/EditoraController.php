<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditoraRequest;
use App\Repositories\EditoraRepository;
use App\Http\Requests;

class EditoraController extends Controller
{

    protected $repository;

    public function __construct(EditoraRepository $editoraRepository)
    {
        $this->repository = $editoraRepository;
    }

    public function index()
    {
        $editoras = $this->repository->index();
        return view('editora.index', compact('editoras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditoraRequest $editoraRequest)
    {
        $this->repository->store($editoraRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->repository->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditoraRequest $editoraRequest, $id)
    {
        $this->repository->update($editoraRequest, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
    }
}
