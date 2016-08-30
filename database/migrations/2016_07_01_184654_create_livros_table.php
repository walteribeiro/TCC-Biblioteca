<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subtitulo');
            $table->string('isbn');
            $table->string('cdu');
            $table->string('cdd');
            $table->integer('ano');
            $table->unsignedBigInteger('publicacao_id')->index('publicacao_idx2');
            $table->unsignedBigInteger('autor_id')->index('autor_idx');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('livros');
    }
}
