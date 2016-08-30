<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revistas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referencia');
            $table->string('categoria');
            $table->unsignedBigInteger('publicacao_id')->index('publicacao_idx1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('revistas');
    }
}
