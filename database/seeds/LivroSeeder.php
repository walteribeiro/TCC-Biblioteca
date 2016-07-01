<?php

use App\Models\Autor;
use App\Models\Editora;
use App\Models\Livro;
use App\Models\Publicacao;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Publicacao::class, 5)->create(
            [
                'editora' => factory(Editora::class)->make()
            ])->each(function($u)
        {
            $u->livro()->save(factory(Livro::class)->make(
                [
                    'autor' => factory(Autor::class)->make()
                ])
            );
        });
    }
}
