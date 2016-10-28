<?php

use App\Models\Publicacao;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestEmprestimo extends TestCase{

    use DatabaseTransactions, DatabaseMigrations;

    public function test_verificar_status_livro_apos_efetuar_emprestimo()
    {
        $repo = $this->app->make("App\\Repositories\\EmprestimoRepository");
        $user = factory(User::class, 1)->create();
        $publicacao = factory(Publicacao::class, 1)->create(['titulo'=> 'Teste livro']);

        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 1]);

        $emprestimo = [
            'data-prevista' => Carbon::now(),
            'usuario' => $user->id,
            'publicacoes' => [$publicacao->id]
        ];

        $repo->store($emprestimo);
        //Após o emprestimo o status do livro deve ser 2
        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 2]);
        $this->assertEquals(1, $repo->index()->count());
    }

    public function test_verificar_status_livro_apos_devolver_emprestimo()
    {
        $repo = $this->app->make("App\\Repositories\\EmprestimoRepository");
        $user = factory(User::class, 1)->create();
        $publicacao = factory(Publicacao::class, 1)->create(['titulo'=> 'Teste livro']);

        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 1]);

        $emprestimo = [
            'data-prevista' => Carbon::now(),
            'usuario' => $user->id,
            'publicacoes' => [$publicacao->id]
        ];

        $repo->store($emprestimo);
        //Após o emprestimo o status do livro deve ser 2
        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 2]);
        $repo->devolver($repo->index()->first()->id);
        //Após a devolução o status do livro deve voltar a ser 1
        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 1]);
    }
}