<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditoraTest extends TestCase{

    use DatabaseTransactions, DatabaseMigrations;

    public function test_listar_editoras()
    {
        $this->be(factory(User::class)->create());
        $this->visit("/editoras")
            ->see("Editoras");
    }
    
    public function test_criar_editora()
    {
        $this->be(factory(User::class)->create());
        $this->visit("/editoras")
            ->click("Novo")
            ->type("Editora de Teste", "nome")
            ->press("Gravar");

        $this->seeInDatabase("editoras", ["nome" => "Editora de Teste"]);
    }

    public function test_navegar_nova_editora()
    {
        $this->be(factory(User::class)->create());
        $this->visit("/editoras")
            ->see("Editoras")
            ->click("Novo")
            ->seePageIs("/editoras/novo")
            ->see("Cadastro de editora");
    }

    public function test_nova_editora_campos_obrigatorios()
    {
        $this->be(factory(User::class)->create());
        $this->visit("/editoras/novo")
            ->type("", "nome")
            ->press("Gravar")
            ->see("O campo nome é obrigatório.");
    }

    public function test_nova_editora_redirecionar_tela_editoras()
    {
        $this->be(factory(User::class)->create());
        $this->visit("/editoras/novo")
            ->type("Editora de Teste", "nome")
            ->press("Gravar")
            ->seePageIs("/editoras")
            ->see("Sucesso");
    }
}