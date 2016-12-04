<?php

namespace App\Repositories;

use App\Models\Funcionario;
use App\User;
use Carbon\Carbon;

class FuncionarioRepository
{
    protected $funcionario;
    protected $usuario;

    public function __construct(Funcionario $funcionario, User $usuario)
    {
        $this->funcionario = $funcionario;
        $this->usuario = $usuario;
    }

    public function index()
    {
        return $this->funcionario->all();
    }

    public function store($data)
    {
        $ativo = $data['ativo'];
        $tipoFuncionario = $data['tipoFuncionario'];

        $this->usuario->username = preg_replace('/\s+/', '', $data['nome'] . Carbon::today()->format('dmY')); //username padrão para funcionários
        $this->usuario->password = bcrypt($data['numeroRegistro']); //senha padrão para funcionários
        $this->usuario->nome = $data['nome'];
        $this->usuario->telefone = $data['telefone'];
        $this->usuario->telefone2 = $data['telefone2'];
        $this->usuario->email = ($data['email'] ? $data['email'] : null);
        $this->usuario->ativo = ($ativo != null ? true : false);
        $this->usuario->tipo_acesso = ($tipoFuncionario == 2 ? 1 : 2); //Colaborador somente para Funcionários do tipo bibliotecário
        $this->usuario->save();

        //Persistindo dados da request no funcionário
        $this->funcionario->num_registro = $data['numeroRegistro'];
        $this->funcionario->tipo_funcionario = $tipoFuncionario;
        $this->usuario->funcionario()->save($this->funcionario);

        return $this->usuario;
    }

    public function update($data, $id)
    {
        $this->usuario = $this->usuario->find($id);
        $ativo = $data['ativo'];
        $tipoFuncionario = $data['tipoFuncionario'];
//dd($tipoFuncionario);
        // Atualizando dados da request no usuário
        $this->usuario->nome = $data['nome'];
        $this->usuario->telefone = $data['telefone'];
        $this->usuario->telefone2 = $data['telefone2'];
        $this->usuario->email = ($data['email'] ? $data['email'] : null);
        $this->usuario->ativo = ($ativo != null ? true : false);
        $this->usuario->tipo_acesso = ($tipoFuncionario == 2 ? 1 : 2);

        //Atualizando dados da request no funcionario
        $this->usuario->funcionario()->update([
            'num_registro' => $data['numeroRegistro'],
            'tipo_funcionario' => $tipoFuncionario
        ]);

        $this->usuario->save();

        return $this->usuario;
    }

    public function destroy($id)
    {
        return $this->usuario->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->funcionario->find($id);
    }
}