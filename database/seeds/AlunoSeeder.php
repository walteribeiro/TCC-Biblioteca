<?php

use App\Models\Aluno;
use App\User;
use Illuminate\Database\Seeder;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make());
        });
    }
}
