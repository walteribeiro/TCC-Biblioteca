<?php

use App\Models\Publicacao;
use App\Models\Revista;
use App\Traits\LogTrait;
use Illuminate\Database\Seeder;

class RevistaSeeder extends Seeder
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
            $u->revista()->save(factory(Revista::class)->make());
            $this->gravarLog("Teste de carga", "debug", ['revista' => $u->titulo]);
        });
    }
}
