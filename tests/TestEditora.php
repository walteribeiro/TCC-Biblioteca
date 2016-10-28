<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestEditora extends TestCase{

    use DatabaseTransactions;

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

    public function test_nova_editora_campo_nome_tamanho_minimo()
    {
        $this->be(factory(User::class)->create());
        $this->visit("/editoras/novo")
            ->type("tes", "nome")
            ->press("Gravar")
            ->see("O campo nome deverá conter no mínimo 5 caracteres.");
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