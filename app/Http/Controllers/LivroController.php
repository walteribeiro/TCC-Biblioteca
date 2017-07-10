<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use App\Models\Publicacao;
use App\Repositories\LivroRepository;
use App\Traits\LogTrait;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class LivroController extends Controller
{
    use LogTrait;

    protected $repository;

    public function __construct(LivroRepository $livroRepository)
    {
        $this->repository = $livroRepository;
    }

    public function index()
    {
        return view('livro.index');
    }

    public function create()
    {
        $livros = $this->repository->create();
        return view('livro.create', compact('livros'));
    }

    public function store(LivroRequest $livroRequest)
    {
        $retorno = $this->repository->store($livroRequest);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgInclusao());
            $this->gravarLog("Livro adicionado!", "informacao", ["Livro" => $retorno->titulo]);
            return redirect()->route('livro.index');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $livro = $this->repository->findById($id);
        $listAutoresEditoras = $this->repository->edit();
        return view('livro.edit', compact('livro', 'listAutoresEditoras'));
    }

    public function update(LivroRequest $livroRequest, $id)
    {
        $retorno = $this->repository->update($livroRequest, $id);
        if($retorno){
            Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
            $this->gravarLog("Livro alterado!", "atencao", ["Livro" => $retorno->titulo]);
            return redirect()->route('livro.index');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $this->repository->destroy($id);
            Session::flash(self::getTipoSucesso(), self::getMsgExclusao());
            $this->gravarLog("Livro excluído!", "alerta");
            return redirect()->route('livro.index');
        }catch(QueryException $e){
            Session::flash(self::getTipoErro(), self::getMsgErroReferenciamento());
            return redirect()->back();
        }
    }

    public function getAll()
    {
        $livros = Livro::join('publicacoes', 'publicacoes.id', '=', 'livros.publicacao_id')
            ->join('editoras', 'editoras.id', '=', 'publicacoes.editora_id')
            ->join('autores', 'autores.id', '=', 'livros.autor_id')
            ->get(['publicacoes.id', 'publicacoes.codigo', 'publicacoes.titulo', 'livros.subtitulo', 'publicacoes.edicao', 'publicacoes.edicao',
                   'publicacoes.status', 'livros.ano', 'livros.isbn', 'livros.cdu', 'livros.cdd', 'editoras.nome as editora', 'autores.nome as autor']);

        return Datatables::of($livros)
            ->addColumn('status', function ($livros) {
                if ($livros->status == 0){
                    $html = '<span class="label label-dark">Desativado</span>';
                }else if ($livros->status == 1){
                    $html = '<span class="label label-success">Disponível</span>';
                }else if ($livros->status == 2) {
                    $html = '<span class="label label-primary">Emprestado</span>';
                }else{
                    $html = '<span class="label label-warning">Reservado</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($livros) {
                $html = '<a href="#show" class="btn btn-sm btn-success" 
                            data-titulo="'. $livros->titulo .'"
                            data-subtitulo="'. $livros->subtitulo .'"
                            data-descricao="'. $livros->descricao .'"
                            data-editora="'. $livros->editora .'"
                            data-autor="'. $livros->autor .'"
                            data-edicao="'. $livros->edicao .'"
                            data-origem="'. $livros->origem .'"
                            data-ano="'. $livros->ano .'"
                            data-isbn="'. $livros->isbn .'"
                            data-cdu="'. $livros->cdu .'"
                            data-cdd="'. $livros->cdd .'"><em class="fa fa-search"></em> Visualizar</a>';
                $html .= '<a href="' . route("livro.edit", $livros->id) . '" class="btn btn-sm btn-warning"><em class="fa fa-pencil"></em> Alterar</a>';
                $html .= '<a href="#modal" class="btn btn-sm btn-danger" data-delete="'. $livros->titulo .'" data-id="'. $livros->id.'"><em class="fa fa-trash-o"></em> Excluir</a>';

                return $html;
            })
            ->make(true);
    }
}
