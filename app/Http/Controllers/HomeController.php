<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Editora;
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

    public function __construct(Livro $livro, Revista $revista, Editora $editora, Autor $autor)
    {
        $this->livro = $livro;
        $this->revista = $revista;
        $this->editora = $editora;
        $this->autor = $autor;
        $this->middleware('auth');
    }

    public function index()
    {
        $livros = $this->livro->all()->count();
        $revistas = $this->revista->all()->count();
        $editoras = $this->editora->all()->count();
        $autores = $this->autor->all()->count();
        return view('welcome', compact('livros', 'revistas', 'editoras', 'autores'));
    }

    /**
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
