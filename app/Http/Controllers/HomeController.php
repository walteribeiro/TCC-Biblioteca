<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Editora;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Revista;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    protected $livro;
    protected $revista;
    protected $editora;
    protected $autor;
    protected $emprestimo;

    public function __construct(Livro $livro, Revista $revista, Editora $editora, Autor $autor, Emprestimo $emprestimo)
    {
        $this->livro = $livro;
        $this->revista = $revista;
        $this->editora = $editora;
        $this->autor = $autor;
        $this->emprestimo = $emprestimo;
    }

    public function index()
    {
        $livros = $this->livro->all()->count();
        $revistas = $this->revista->all()->count();
        $editoras = $this->editora->all()->count();
        $autores = $this->autor->all()->count();
        $emprestimos = $this->emprestimo->all()->count();
        return view('welcome', compact('livros', 'revistas', 'editoras', 'autores', 'emprestimos'));
    }
}
