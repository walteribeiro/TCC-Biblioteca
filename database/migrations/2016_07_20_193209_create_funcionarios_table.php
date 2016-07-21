<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
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
         */
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num_registro', 10)->unique()->nullable();
            $table->tinyInteger('tipo_funcionario')->default(0);
            $table->unsignedBigInteger('user_id')->index('user_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funcionarios');
    }
}
