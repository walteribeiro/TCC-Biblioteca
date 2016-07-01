<?php

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
        //$this->call(EditoraSeeder::class);
        //$this->call(AutorSeeder::class);
        $this->call(LivroSeeder::class);
    }
}
