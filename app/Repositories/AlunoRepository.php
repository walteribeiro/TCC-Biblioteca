<?php

namespace App\Repositories;

use App\User;
use Carbon\Carbon;

class AlunoRepository
{
    protected $usuario;

    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }

    public function index()
    {
        return $this->usuario->all();
    }

    public function store($data)
    {
        $ativo = $data->input('ativo');

        // Persistindo dados da request no usuário
        $this->usuario->username = preg_replace('/\s+/', '', $data['nome'] . Carbon::today()->format('dmY')); //usuario padrão para aluno
        $this->usuario->password = bcrypt($data['matricula']); //senha padrão para aluno
        $this->usuario->nome = $data['nome'];
        $this->usuario->telefone = $data['telefone'];
        $this->usuario->telefone2 = $data['telefone2'];
        $this->usuario->email = ($data['email'] ? $data['email'] : null);
        $this->usuario->ativo = ($ativo != null ? true : false);
        $this->usuario->tipo_pessoa = 3; //Padrão para todos alunos
        $this->usuario->matricula = $data['matricula'];
        $this->usuario->save();

        return $this->usuario;
    }

    public function update($data, $id)
    {
        $this->usuario = $this->usuario->find($id);
        $ativo = $data['ativo'];

        // Atualizando dados da request no usuário
        $this->usuario->nome = $data['nome'];
        $this->usuario->telefone = $data['telefone'];
        $this->usuario->telefone2 = $data['telefone2'];
        $this->usuario->email = ($data['email'] ? $data['email'] : null);
        $this->usuario->ativo = ($ativo != null ? true : false);
        $this->usuario->matricula = $data['matricula'];
        $this->usuario->save();

        return $this->usuario;
    }

    public function destroy($id)
    {
        return $this->usuario->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->usuario->find($id);
    }
}