<?php

namespace App\Repositories;

use App\Models\Emprestimo;
use App\Models\Publicacao;
use App\Models\Reserva;
use App\User;
use Carbon\Carbon;

class ReservaRepository
{
    protected $reserva;
    protected $publicacao;
    protected $emprestimoRepository;

    public function __construct(Reserva $reserva, Publicacao $publicacao, EmprestimoRepository $emprestimoRepository)
    {
        $this->reserva = $reserva;
        $this->publicacao = $publicacao;
        $this->emprestimoRepository = $emprestimoRepository;
    }

    public function index()
    {
        return $this->reserva->all();
    }

    public function store($data)
    {
        $this->reserva->data_reserva = Carbon::now();
        $this->reserva->data_limite = $data['data-limite'];
        $this->reserva->situacao = 0;
        $this->reserva->user_id = $data['usuario'];
        $this->reserva->save();

        $publicacao_id = $data['publicacao'];

        $pub = $this->publicacao->find($publicacao_id);
        $pub->status = 3;
        $pub->save();

        return $this->reserva->publicacoes()->sync([$publicacao_id], false);
    }

    public function update($data, $id)
    {
        $this->reserva = $this->findById($id);

        $this->reserva->update([
            'data_reserva' => Carbon::now(),
            'data_limite' => $data['data-limite'],
            'situacao' => 0
        ]);

        return $this->reserva;
    }

    public function destroy($id)
    {
        $this->reserva = $this->findById($id);
        foreach($this->reserva->publicacoes()->getRelatedIds() as $ident){
            $pub = $this->publicacao->find($ident);
            $pub->status = 1;
            $pub->save();
        }

        return $this->reserva->destroy($id);
    }

    public function findById($id)
    {
        return $this->reserva->find($id);
    }

    public function emprestar($id)
    {
        //Busca a reserva
        $this->reserva = $this->findById($id);

        //Atualiza a situacao da reserva para fechada!
        $this->reserva->update([
            'situacao' => 1
        ]);

        //Gera um emprestimo
        $emprestimo = [
            'data-prevista' => Carbon::now()->addDays(7),
            'usuario' => $this->reserva->user_id,
            'publicacao' => $this->reserva->publicacoes()->first()->id
        ];

        $gravouEmprestimo = $this->emprestimoRepository->storeReservaEmprestimo($emprestimo);

        return !empty($gravouEmprestimo['attached']);
    }

    public function verificarUsuarioEmprestimo($id)
    {
        //Busca a reserva
        $this->reserva = $this->findById($id);

        $usuario = User::join('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->where([['emprestimos.situacao', '0'], ['emprestimos.user_id', $this->reserva->user_id]])
            ->get(['pessoas.nome']);

        return count($usuario) > 0 ? false : true;
    }

    public function verificarPublicacaoEmprestada($id)
    {
        //Busca a reserva
        $this->reserva = $this->findById($id);

        $usuario = Publicacao::select('emprestimos', 'emprestimos.user_id', '=', 'pessoas.id')
            ->where([['emprestimos.situacao', '0'], ['emprestimos.user_id', $this->reserva->user_id]])
            ->get(['pessoas.nome']);

        //dd($usuario);

        return count($usuario) > 0 ? false : true;
    }
}