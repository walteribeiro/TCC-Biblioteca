<?php

use App\Models\Autor;
use App\Repositories\Helpers\LogTrait;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    use LogTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Autor::class, 150)->create()->each(function($u){
            $this->gravarLog("Teste de carga", "debug", ['autor.nome' => $u->nome, 'autor.sobrenome' => $u->sobrenome]);
        });
    }
}
