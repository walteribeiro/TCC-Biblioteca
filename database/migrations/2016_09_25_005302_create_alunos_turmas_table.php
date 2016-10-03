<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos_turmas', function (Blueprint $table) {
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('turma_id');
            $table->primary(array('aluno_id', 'turma_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alunos_turmas');
    }
}
