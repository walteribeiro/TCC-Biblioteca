<?php

namespace App\Repositories;

use App\Http\Requests\FuncionarioRequest;
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

    public function store(FuncionarioRequest $funcionarioRequest)
    {
        $ativo = $funcionarioRequest->input('ativo');
        // Persistindo dados da request no usuário
        $this->usuario->username = $funcionarioRequest->input('username');
        $this->usuario->password = bcrypt($funcionarioRequest->input('senha'));
        $this->usuario->nome = $funcionarioRequest->input('nome');
        $this->usuario->telefone = $funcionarioRequest->input('telefone');
        $this->usuario->telefone2 = $funcionarioRequest->input('telefone2');
        $this->usuario->email = $funcionarioRequest->input('email');
        $this->usuario->ativo = ($ativo != null ?true:false);
        $this->usuario->tipo_acesso = 1; //Colaborador para todos tipos de Funcionários
        $this->usuario->save();

        //Persistindo dados da request no funcionário
        $this->funcionario->num_registro = $funcionarioRequest->input('numeroRegistro');
        $this->funcionario->tipo_funcionario = $funcionarioRequest->input('tipoFuncionario');
        $this->usuario->funcionario()->save($this->funcionario);

        return $this->usuario;
    }

    public function update(FuncionarioRequest $funcionarioRequest, $id)
    {
        $this->usuario = $this->usuario->find($id);
        $ativo = $funcionarioRequest->input('ativo');

        // Atualizando dados da request no usuário
        $this->usuario->username = $funcionarioRequest->input('username');
        $this->usuario->password = bcrypt($funcionarioRequest->input('senha'));
        $this->usuario->nome = $funcionarioRequest->input('nome');
        $this->usuario->telefone = $funcionarioRequest->input('telefone');
        $this->usuario->telefone2 = $funcionarioRequest->input('telefone2');
        $this->usuario->email = $funcionarioRequest->input('email');
        $this->usuario->ativo = ($ativo != null ?true:false);

        //Atualizando dados da request no funcionario
        $this->usuario->funcionario()->update([
            'num_registro' => $funcionarioRequest->input('numeroRegistro'),
            'tipo_funcionario' => $funcionarioRequest->input('tipoFuncionario')
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