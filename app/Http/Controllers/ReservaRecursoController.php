<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRecursoRequest;
use App\Repositories\ReservaRecursoRepository;
use App\Traits\LogTrait;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ReservaRecursoController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(ReservaRecursoRepository $reservaRecursoRepository)
    {
        $this->repository = $reservaRecursoRepository;
    }


    public function index()
    {
        $reservaRecurso = $this->repository->index();
        return view('reserva-recurso.index', compact('reservaRecurso'));
    }

    public function getdata()
    {
        return $this->repository->getData();
    }

    public function store(ReservaRecursoRequest $reservaRecursoRequest)
    {
        $retorno = $this->repository->store($reservaRecursoRequest->all());
        if($retorno){
            $this->gravarLog("Reserva de recurso adicionada!", "informacao", ["Data" => Carbon::today()->format('d/m/Y')]);
            return json_encode($retorno);
        }
        return response()->json([
            'tipo' => self::getTipoErro(),
            'mensagem' => self::getMsgErroReferenciamento()
        ], 400);
    }

    public function update(ReservaRecursoRequest $reservaRecursoRequest)
    {
        $retorno = $this->repository->update($reservaRecursoRequest->all());
        if($retorno){
            $this->gravarLog("Reserva de recurso alterada!", "atencao", ["Data" => Carbon::today()->format('d/m/Y')]);
            return json_encode($retorno);
        }
        return response()->json([
            'tipo' => self::getTipoErro(),
            'mensagem' => self::getMsgErroReferenciamento()
        ], 400);
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Reserva de recurso excluída!", "alerta", ["Data" => Carbon::today()->format('d/m/Y')]);
            return response()->json([
                'tipo' => self::getTipoSucesso(),
                'mensagem' => self::getMsgExclusao()
            ]);
        }catch(QueryException $e){
            return response()->json([
                'tipo' => self::getTipoErro(),
                'mensagem' => self::getMsgErroReferenciamento()
            ], 400);
        }
    }
}
