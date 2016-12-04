<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservasPublicacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_publicacoes', function (Blueprint $table) {
            $table->unsignedBigInteger('reserva_id');
            $table->unsignedBigInteger('publicacao_id');
            $table->primary(array('reserva_id', 'publicacao_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservas_publicacoes');
    }
}
