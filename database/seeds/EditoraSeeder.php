<?php

use App\Models\Editora;
use App\Traits\LogTrait;
use Illuminate\Database\Seeder;

class EditoraSeeder extends Seeder
{
    use LogTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Editora::class, 150)->create()->each(function($u){
            $this->gravarLog("Teste de carga", "debug", ['editora' => $u->nome]);
        });
    }
}