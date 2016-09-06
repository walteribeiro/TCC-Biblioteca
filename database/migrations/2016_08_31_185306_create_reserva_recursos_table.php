<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_recursos', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data_reserva');
            $table->string('aula');
            $table->unsignedBigInteger('funcionario_id')->index('funcionario_idx');
            $table->unsignedBigInteger('recurso_id')->index('recurso_idx');
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
        Schema::drop('reserva_recursos');
    }
}
