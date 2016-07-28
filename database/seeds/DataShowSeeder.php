<?php

use App\Models\DataShow;
use App\Models\Recurso;
use App\Traits\LogTrait;
use Illuminate\Database\Seeder;

class DataShowSeeder extends Seeder
{
    use LogTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recurso::class, 150)->create()->each(function($u){
            $u->dataShow()->save(factory(DataShow::class)->make());
            $this->gravarLog("Teste de carga", "debug", ['data show' => $u->descricao]);
        });
    }
}
