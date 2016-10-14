<?php

namespace App\Repositories;

use App\Models\Aluno;
use App\User;

class AlunoRepository
{
    protected $aluno;
    protected $usuario;

    public function __construct(Aluno $aluno, User $usuario)
    {
        $this->aluno = $aluno;
        $this->usuario = $usuario;
    }

    public function index()
    {
        return $this->aluno->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store($data)
    {
        $ativo = $data->input('ativo');

        // Persistindo dados da request no usuário

        if ($data['username'] == '') {
            $this->usuario->username = null;
        } else {
            $this->usuario->username = $data['username'];
        }
        $this->usuario->password = bcrypt($data['senha']);
        $this->usuario->nome = $data['nome'];
        $this->usuario->telefone = $data['telefone'];
        $this->usuario->telefone2 = $data['telefone2'];
        $this->usuario->email = $data['email'];
        $this->usuario->ativo = ($ativo != null ? true : false);
        $this->usuario->tipo_acesso = 2; //Padrão para todos alunos
        $this->usuario->save();

        //Persistindo dados da request no aluno
        $this->aluno->matricula = $data['matricula'];
        $this->usuario->aluno()->save($this->aluno);

        return $this->usuario;
    }

    public function update($data, $id)
    {
        $this->usuario = $this->usuario->find($id);
        $ativo = $data['ativo'];

        // Atualizando dados da request no usuário
        if ($data['username'] == '') {
            $this->usuario->username = null;
        } else {
            $this->usuario->username = $data['username'];
        }
        $this->usuario->password = bcrypt($data['senha']);
        $this->usuario->nome = $data['nome'];
        $this->usuario->telefone = $data['telefone'];
        $this->usuario->telefone2 = $data['telefone2'];
        $this->usuario->email = $data['email'];
        $this->usuario->ativo = ($ativo != null ? true : false);

        //Atualizando dados da request no aluno
        $this->usuario->aluno()->update([
            'matricula' => $data['matricula']
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
        return $this->aluno->find($id);
    }

    public function countAlunos($id, $matricula){
        return $this->aluno->where([['matricula', '=', $matricula], ['user_id', '<>', $id]])->count();
    }
}