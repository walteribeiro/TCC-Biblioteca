<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Criar usuário Admin
        factory(User::class, 1)->create([
            'nome' => 'EEAC',
            'username' => 'Administrador',
            'password' => bcrypt('admeeac2016'),
            'tipo_acesso' => 0
        ]);

        factory(User::class, 1)->create([
            'nome' => 'EEAC demonstração',
            'username' => 'teste',
            'password' => bcrypt('teste'),
            'tipo_acesso' => 0
        ]);

        //$this->call(EditoraSeeder::class);
        //$this->call(AutorSeeder::class);
        //$this->call(LivroSeeder::class);
        //$this->call(FuncionarioSeeder::class);
    }
}
