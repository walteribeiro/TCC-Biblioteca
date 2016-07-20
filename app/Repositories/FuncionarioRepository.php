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
        // Persistindo dados da request no usuário
        $this->usuario->username = $funcionarioRequest->input('username');
        $this->usuario->password = bcrypt($funcionarioRequest->input('password'));
        $this->usuario->nome = $funcionarioRequest->input('nome');
        $this->usuario->telefone = $funcionarioRequest->input('telefone');
        $this->usuario->telefone2 = $funcionarioRequest->input('telefone2');
        $this->usuario->email = $funcionarioRequest->input('email');
        $this->usuario->ativo = $funcionarioRequest->input('ativo');
        $this->usuario->tipo_acesso = 1; //Colaborador para todos tipos de Funcionários
        $this->usuario->save();

        //Persistindo dados da request no funcionário
        $this->funcionario->num_registro = $funcionarioRequest->input('subtelefone');
        $this->funcionario->tipo_funcionario = $funcionarioRequest->input('isbn');
        $this->usuario->funcionario()->save($this->funcionario);

        return $this->usuario;
    }

    public function update(FuncionarioRequest $funcionarioRequest, $id)
    {
        $this->usuario = $this->usuario->find($id);

        // Atualizando dados da request no usuário
        $this->usuario->username = $funcionarioRequest->input('username');
        $this->usuario->password = bcrypt($funcionarioRequest->input('password'));
        $this->usuario->nome = $funcionarioRequest->input('nome');
        $this->usuario->telefone = $funcionarioRequest->input('telefone');
        $this->usuario->telefone2 = $funcionarioRequest->input('telefone2');
        $this->usuario->email = $funcionarioRequest->input('email');
        $this->usuario->ativo = $funcionarioRequest->input('ativo');

        //Atualizando dados da request no funcionario
        $this->usuario->funcionario()->update([
            'num_registro' => $funcionarioRequest->input('num_registro'),
            'tipo_funcionario' => $funcionarioRequest->input('tipo_funcionario')
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
        return $this->usuario->find($id);
    }
}