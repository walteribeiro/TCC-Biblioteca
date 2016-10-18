<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmprestimosPublicacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos_publicacoes', function (Blueprint $table) {
            $table->unsignedBigInteger('emprestimo_id');
            $table->unsignedBigInteger('publicacao_id');
            $table->primary(array('emprestimo_id', 'publicacao_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emprestimos_publicacoes');
    }
}
