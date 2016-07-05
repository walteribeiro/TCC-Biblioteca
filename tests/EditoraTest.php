<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditoraTest extends TestCase
{
    protected $listExcluir = [];

    public function test_criar_editora()
    {
        $this->visit('/')
            ->visit('/editoras')
            ->visit('editoras/novo')
            ->type('Editora de Teste', 'nome')
            ->press('Gravar')
            ->seePageIs('/editoras')
            ->see('Editora Teste');
    }

    private function findLast()
    {
        
    }
}
