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
         * Tipos de acesso:
         *  0 - Administrador
         *  1 - Colaborador
         *  2 - Padrão
         */
        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nome');
            $table->string('telefone', 15);
            $table->string('telefone2', 15);
            $table->string('email');
            $table->boolean('ativo')->default(true);
            $table->tinyInteger('tipo_acesso')->default(2);
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
