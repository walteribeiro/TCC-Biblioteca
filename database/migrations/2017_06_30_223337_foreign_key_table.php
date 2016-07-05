<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publicacoes', function (Blueprint $table) {
            $table->foreign('editora_id', 'editora_1_fk')->references('id')->on('editoras')->onUpdate('cascade')->onDelete('restrict');
        });
        Schema::table('livros', function (Blueprint $table) {
            $table->foreign('publicacao_id', 'publicacao_1_fk')->references('id')->on('publicacoes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('autor_id', 'autor_2_fk')->references('id')->on('autores')->onUpdate('cascade')->onDelete('restrict');
        });
        Schema::table('revistas', function (Blueprint $table) {
            $table->foreign('publicacao_id', 'publicacao_2_fk')->references('id')->on('publicacoes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publicacoes', function(Blueprint $table)
        {
            $table->dropForeign('editora_1_fk');
        });

        Schema::table('livros', function(Blueprint $table)
        {
            $table->dropForeign('publicacao_1_fk');
            $table->dropForeign('autor_2_fk');
        });
        Schema::table('revistas', function(Blueprint $table)
        {
            $table->dropForeign('publicacao_2_fk');
        });

        //
    }
}
