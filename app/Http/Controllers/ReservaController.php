<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ReservaRequest;
use App\Models\Publicacao;
use App\Repositories\ReservaRepository;
use App\Traits\LogTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class ReservaController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(ReservaRepository $reservaRepository)
    {
        $this->repository = $reservaRepository;
    }

    public function index()
    {
        $reservas = $this->repository->index();
        return view('reserva.index', compact('reservas'));
    }

    public function create()
    {
        $usuarios = User::whereNotIn('id', function($query){
            $query->select('pessoas.id')
                ->from('pessoas')
                ->join('reservas', 'pessoas.id', '=', 'reservas.user_id')
                ->where('reservas.situacao', '0');
        })->where([['tipo_acesso', '<>', 0], ['ativo', '=', '1']])
            ->get(['id', 'nome']);

        $publicacoes = Publicacao::whereNotIn('status', [0, 2, 3])->get();
        $data_limite = Carbon::today()->addDays(7)->format('Y-m-d');
        return view('reserva.create', compact('usuarios', 'publicacoes', 'data_limite'));
    }

    public function store(ReservaRequest $reservaRequest)
    {
        $gravouReserva = $this->repository->store($reservaRequest->all());

        if(!empty($gravouReserva['attached'])){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Reserva adicionada!", "informacao", ["Data" => Carbon::today()->format('d/m/Y')]);
            return redirect()->route('reserva.index');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $reserva = $this->repository->findById($id);
        return view("reserva.edit", compact('reserva'));
    }

    public function update(ReservaRequest $reservaRequest, $id)
    {
        $retorno = $this->repository->update($reservaRequest->all(), $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Reserva alterada!", "atencao", ["Data" => Carbon::today()->format('d/m/Y')]);
            return redirect()->route('reserva.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Empréstimo excluído!", "alerta");
            return redirect()->route('reserva.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }

    public function efetuarEmprestimo($id)
    {
        $naoPossuiEmprestimo = $this->repository->verificarUsuarioEmprestimo($id);

        if($naoPossuiEmprestimo) {
            $retorno = $this->repository->emprestar($id);
            if ($retorno) {
                Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
                $this->gravarLog("Reserva emprestada!", "alerta", ["Data" => Carbon::today()->format('d/m/Y')]);
                return redirect()->route('reserva.index');
            }
        }
        Session::flash(self::getTipoErro(), self::getMsgErroEmprestimo());
        return redirect()->back();
    }
}
