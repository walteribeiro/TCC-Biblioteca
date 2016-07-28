<?php

use App\Models\Livro;
use App\Models\Publicacao;
use App\Traits\LogTrait;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    use LogTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Publicacao::class, 50)->create()->each(function($u){
            $u->livro()->save(factory(Livro::class)->make());
            $this->gravarLog("Teste de carga", "debug", ['livro' => $u->titulo]);
        });
    }
}
