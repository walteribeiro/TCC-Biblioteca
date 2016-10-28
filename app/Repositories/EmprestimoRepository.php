<?php

namespace App\Repositories;


use App\Models\Emprestimo;
use App\Models\Publicacao;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class EmprestimoRepository
{
    protected $emprestimo;
    protected $publicacao;

    public function __construct(Emprestimo $emprestimo, Publicacao $publicacao)
    {
        $this->emprestimo = $emprestimo;
        $this->publicacao = $publicacao;
    }

    public function index()
    {
        return $this->emprestimo->all();
    }

    public function store($data)
    {
        $this->emprestimo->data_emprestimo = Carbon::now();
        $this->emprestimo->data_devolucao = null;
        $this->emprestimo->data_prevista = $data['data-prevista'];
        $this->emprestimo->situacao = 0;
        $this->emprestimo->user_id= $data['usuario'];
        $this->emprestimo->save();

        $publicacoes_id = $data['publicacoes'];

        foreach($publicacoes_id as $id){
            $pub = $this->publicacao->find($id);
            $pub->status = 2;
            $pub->save();
        }

        return $this->emprestimo->publicacoes()->sync($publicacoes_id, false);
    }

    public function update($data, $id)
    {
        $this->emprestimo = $this->findById($id);

        $this->emprestimo->update([
            'data_emprestimo' => Carbon::now(),
            'data_devolucao' => null,
            'data_prevista' => $data['data-prevista'],
            'situacao' => 0
        ]);

        return $this->emprestimo;
    }

    public function destroy($id)
    {
        $this->emprestimo = $this->findById($id);
        foreach($this->emprestimo->publicacoes()->getRelatedIds() as $ident){
            $pub = $this->publicacao->find($ident);
            $pub->status = 1;
            $pub->save();
        }

        return $this->emprestimo->destroy($id);
    }

    public function findById($id)
    {
        return $this->emprestimo->find($id);
    }

    public function devolver($id)
    {
        //Busca o emprestimo
        $this->emprestimo = $this->findById($id);

        //Atualiza a situacao do emprestimo para devolvido = !
        $this->emprestimo->update([
            'data_devolucao' => Carbon::now(),
            'situacao' => 1
        ]);

        //Atualiza os status dos livros para disponíveis = 1
        foreach($this->emprestimo->publicacoes()->getRelatedIds() as $id){
            $pub = $this->publicacao->find($id);
            $pub->status = 1;
            $pub->save();
        }

        return $this->emprestimo;
    }
}