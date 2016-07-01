<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao');
            $table->string('titulo');
            $table->string('edicao');
            $table->string('origem');
            $table->unsignedBigInteger('editora_id')->index('editora_idx');
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
        Schema::drop('publicacoes');
    }
}
