<?php

namespace App\Repositories;

use App\Models\Funcionario;
use App\User;

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

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store($data)
    {
        $ativo = $data->input('ativo');

        // Persistindo dados da request no usuário
        $this->usuario->username = $data['username'];
        $this->usuario->password = bcrypt($data['senha']);
        $this->usuario->nome = $data['nome'];
        $this->usuario->telefone = $data['telefone'];
        $this->usuario->telefone2 = $data['telefone2'];
        $this->usuario->email = $data['email'];
        $this->usuario->ativo = ($ativo != null ? true : false);
        $this->usuario->tipo_acesso = 1; //Colaborador para todos tipos de Funcionários
        $this->usuario->save();

        //Persistindo dados da request no funcionário
        $this->funcionario->num_registro = $data['numeroRegistro'];
        $this->funcionario->tipo_funcionario = $data['tipoFuncionario'];
        $this->usuario->funcionario()->save($this->funcionario);

        return $this->usuario;
    }

    public function update($data, $id)
    {
        $this->usuario = $this->usuario->find($id);
        $ativo = $data['ativo'];

        // Atualizando dados da request no usuário
        $this->usuario->username = $data['username'];
        $this->usuario->password = bcrypt($data['senha']);
        $this->usuario->nome = $data['nome'];
        $this->usuario->telefone = $data['telefone'];
        $this->usuario->telefone2 = $data['telefone2'];
        $this->usuario->email = $data['email'];
        $this->usuario->ativo = ($ativo != null ?true:false);

        //Atualizando dados da request no funcionario
        $this->usuario->funcionario()->update([
            'num_registro' => $data['numeroRegistro'],
            'tipo_funcionario' => $data['tipoFuncionario']
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