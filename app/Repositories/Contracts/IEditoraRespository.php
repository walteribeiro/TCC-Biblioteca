<?php

namespace App\Repositories\Contracts;

interface IEditoraRepository
{
    public function index();
    public function show($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}