<?php

use App\Models\Editora;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditoraTest extends TestCase
{
    protected $editora;

    public function setUp()
    {
        $this->editora = new Editora();
        $this->editora->nome = "Editora de teste";
    }

    public function test_nome_da_editora()
    {
        $this->assertEquals('Editora de teste', $this->editora->nome);
    }
}
