<?php

namespace App\Repositories;

use App\Models\Publicacao;
use App\Models\Reserva;
use Carbon\Carbon;

class ReservaRepository
{
    protected $reserva;
    protected $publicacao;

    public function __construct(Reserva $reserva, Publicacao $publicacao)
    {
        $this->reserva = $reserva;
        $this->publicacao = $publicacao;
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
        $this->reserva->publicacao_id = $data['publicacao'];
        $this->reserva->save();

        $publicacao_id = $data['publicacao'];

        $pub = $this->publicacao->find($publicacao_id);
        $pub->status = 3;
        $pub->save();

        return $this->reserva;
    }

    public function update($data, $id)
    {
        $this->reserva = $this->findById($id);

        $this->reserva->update([
            'data_reserva' => Carbon::now(),
            'data_devolucao' => null,
            'data_prevista' => $data['data-prevista'],
            'situacao' => 0
        ]);

        return $this->reserva;
    }

    public function destroy($id)
    {
        $this->reserva = $this->findById($id);

        $pub = $this->publicacao;
        $pub->status = 1;
        $pub->save();

        return $this->reserva->destroy($id);
    }

    public function findById($id)
    {
        return $this->reserva->find($id);
    }

    public function devolver($id)
    {
        //Busca o reserva
        $this->reserva = $this->findById($id);

        //Atualiza a situacao do reserva para devolvido = !
        $this->reserva->update([
            'data_devolucao' => Carbon::now(),
            'situacao' => 1
        ]);

        //Atualiza os status dos livros para disponíveis = 1
        foreach($this->reserva->publicacoes()->getRelatedIds() as $id){
            $pub = $this->publicacao->find($id);
            $pub->status = 1;
            $pub->save();
        }

        return $this->reserva;
    }
}