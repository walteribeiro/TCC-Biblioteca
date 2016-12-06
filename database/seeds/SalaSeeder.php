<?php

use App\Models\Recurso;
use App\Models\Sala;
use App\Traits\LogTrait;
use Illuminate\Database\Seeder;

class SalaSeeder extends Seeder
{
    use LogTrait;

    public function run()
    {
        factory(Recurso::class, 10)->create()->each(function($u){
            $u->sala()->save(factory(Sala::class)->make());
            $this->gravarLog("Teste de carga", "debug", ['sala' => $u->descricao]);
        });
    }
}
