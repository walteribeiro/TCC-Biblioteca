<?php

use App\Models\Mapa;
use App\Models\Recurso;
use App\Traits\LogTrait;
use Illuminate\Database\Seeder;

class MapaSeeder extends Seeder
{
    use LogTrait;

    public function run()
    {
        factory(Recurso::class, 150)->create()->each(function($u){
            $u->mapa()->save(factory(Mapa::class)->make());
            $this->gravarLog("Teste de carga", "debug", ['mapa' => $u->descricao]);
        });
    }
}
