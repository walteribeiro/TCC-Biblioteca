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
        return [
            'funcionarios'=> $this->funcionario->all(),
            'recursos'=> $this->recurso->all()
        ];
    }

    /**
     * Essa função é chamada via Ajax na view para efetuar o carregamento dos eventos no calendário
     * @return string
     */
    public function getData()
    {
        $objs = $this->reservaRecurso->all();
        $retorno = array();
        foreach($objs as $key => $value){

            $e = array();
            $e['id'] = $value['id'];
            $e['title'] = $value->recurso->descricao . " - " . $this->getAula($value->aula);
            $e['start'] = $value['data_reserva'];
            $e['end'] = $value['data_reserva'];

            array_push($retorno, $e);
        }

        return json_encode($retorno);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function create()
    {
        return [
            'funcionarios' => $this->funcionario->where('tipo_funcionario', 1)->get(),
            'recursos' => $this->recurso->all()
        ];
    }

    public function store($data)
    {
        //Persistindo dados da request no reservaRecurso
        $this->reservaRecurso->data_reserva = $data['start'];
        $this->reservaRecurso->aula = $data['aula'];
        $this->reservaRecurso->funcionario_id = $data['funcionario'];
        $this->reservaRecurso->recurso_id = $data['recurso'];
        $this->reservaRecurso->save();

        return $this->reservaRecurso;
    }

    public function edit()
    {
        return [
            'funcionarios' => $this->funcionario->all(),
            'recursos' => $this->recurso->all()
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

    private function getAula($aula){

        switch ($aula){
            case "1":
                return "1 M";
            case "2":
                return "2 M";
            case "3":
                return "3 M";
            case "4":
                return "4 M";
            case "5":
                return "5 M";
            case "6":
                return "1 T";
            case "7":
                return "2 T";
            case "8":
                return "3 T";
            case "9":
                return "4 T";
            case "10":
                return "5 T";
            case "11":
                return "1 N";
            case "12":
                return "2 N";
            case "13":
                return "3 N";
            case "14":
                return "4 N";
            case "15":
                return "5 N";
            default:
                return "";
        }
    }
}