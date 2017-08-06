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
            $table->bigIncrements('id');
            $table->date('data_reserva');
            $table->integer('aula');
            $table->unsignedBigInteger('user_id')->index('user_idx');
            $table->unsignedBigInteger('recurso_id')->index('recurso_idx');
            //$table->unique(['recurso_id','aula']);
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
