<?php

use App\Models\Funcionario;
use App\User;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function($u){
            $u->funcionario()->save(factory(Funcionario::class)->make());
        });
    }
}
