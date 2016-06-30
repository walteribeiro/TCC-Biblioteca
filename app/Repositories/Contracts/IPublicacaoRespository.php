<?php

namespace App\Repositories;

interface IPublicacaoRepository
{
    public function index();
    public function show($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}