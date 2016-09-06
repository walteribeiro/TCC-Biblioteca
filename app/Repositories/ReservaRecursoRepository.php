<?php

namespace App\Repositories;


use App\Models\Funcionario;
use App\Models\Recurso;
use App\Models\ReservaRecurso;

class ReservaRecursoRepository
{
    protected $reservaRecurso;
    protected $funcionario;
    protected $recurso;

    public function __construct(ReservaRecurso $reservaRecurso, Funcionario $funcionario, Recurso $recurso)
    {
        $this->reservaRecurso = $reservaRecurso;
        $this->funcionario = $funcionario;
        $this->recurso = $recurso;
    }

    public function index()
    {
        return $this->reservaRecurso->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function create(){
        return [
            'funcionarios'=> $this->funcionario->all(),
            'recursos'=> $this->recurso->all()
        ];
    }

    public function store($data)
    {
        //Persistindo dados da request no reservaRecurso
        $this->reservaRecurso->data_reserva = $data['data_reserva'];
        $this->reservaRecurso->aula = $data['aula'];
        $this->reservaRecurso->funcionario_id = $data['funcionario'];
        $this->reservaRecurso->recurso_id = $data['recurso'];
        $this->reservaRecurso->save();

        return $this->reservaRecurso;
    }

    public function edit(){
        return [
            'funcionarios'=> $this->funcionario->all(),
            'recursos'=> $this->recurso->all()
        ];
    }

    public function update($data, $id)
    {
        $this->reservaRecurso = $this->reservaRecurso->find($id);


        //Atualizando dados da request no reservaRecurso
        $this->reservaRecurso->update([
            'data_reserva' => $data['data_reserva'],
            'aula' => $data['aula'],
            'funcionario_id' => $data['funcionario'],
            'recurso_id' => $data['recurso'],
        ]);

        $this->reservaRecurso->save();

        return $this->reservaRecurso;
    }

    public function destroy($id)
    {
        return $this->reservaRecurso->destroy([$id]);
    }

    public function findById($id)
    {
        return $this->reservaRecurso->find($id);
    }
}