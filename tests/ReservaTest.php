<?php

use App\Models\Publicacao;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReservaTest extends TestCase{

    use DatabaseTransactions, DatabaseMigrations;

    public function test_verificar_status_publicacao_apos_efetuar_reserva()
    {
        $repo = $this->app->make("App\\Repositories\\ReservaRepository");
        $user = factory(User::class, 1)->create();
        $publicacao = factory(Publicacao::class, 1)->create(['titulo'=> 'Teste livro']);

        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 1]);

        $reserva = [
            'data-limite' => Carbon::now(),
            'usuario' => $user->id,
            'publicacao' => $publicacao->id
        ];

        $repo->store($reserva);
        //Após a reserva o status do livro deve ser 3
        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 3]);
        $this->assertEquals(1, $repo->index()->count());
    }

    public function test_verificar_status_publicacao_apos_transformar_emprestimo()
    {
        $repo = $this->app->make("App\\Repositories\\ReservaRepository");
        $user = factory(User::class, 1)->create();
        $publicacao = factory(Publicacao::class, 1)->create(['titulo'=> 'Teste livro']);

        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 1]);

        $reserva = [
            'data-limite' => Carbon::now(),
            'usuario' => $user->id,
            'publicacao' => $publicacao->id
        ];

        $repo->store($reserva);

        //Após a reserva o status do livro deve ser 3
        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 3]);
        $repo->emprestar($repo->index()->first()->id);
        //Após transformar em emprestimo o status do livro deve ser 2
        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 2]);
    }

    public function test_verificar_status_publicacao_apos_excluir_emprestimo()
    {
        $repo = $this->app->make("App\\Repositories\\ReservaRepository");
        $user = factory(User::class, 1)->create();
        $publicacao = factory(Publicacao::class, 1)->create(['titulo'=> 'Teste livro']);

        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 1]);

        $reserva = [
            'data-limite' => Carbon::now(),
            'usuario' => $user->id,
            'publicacao' => $publicacao->id
        ];

        $repo->store($reserva);
        //Após a reserva o status do livro deve ser 3
        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 3]);
        $repo->destroy($repo->index()->first()->id);
        //Após a exclusão o status do livro deve voltar a ser 1
        $this->seeInDatabase('publicacoes', ['titulo'=> 'Teste livro', 'status'=> 1]);
    }
}