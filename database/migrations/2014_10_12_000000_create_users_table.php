<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Tipos de Funcionário:
         *  0 - Geral
         *  1 - Professor
         *  2 - Bibliotecário
         *  3 - Aluno
         *  4 - Administrador
         */
        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('nome');
            $table->string('telefone', 15)->nullable();
            $table->string('telefone2', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('matricula')->unique()->nullable();
            $table->boolean('ativo')->default(true);
            $table->tinyInteger('tipo_pessoa')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pessoas');
    }
}
