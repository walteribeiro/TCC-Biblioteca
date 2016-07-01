<?php

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
        factory(Publicacao::class, 5)->create()->each(function($u){
            $u->livro()->save(factory(Livro::class)->make());
        });
    }
}
