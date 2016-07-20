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
            $table->foreign('editora_id', 'publicacoes_1_fk')->references('id')->on('editoras')->onUpdate('cascade')->onDelete('restrict');
        });
        Schema::table('livros', function (Blueprint $table) {
            $table->foreign('publicacao_id', 'livros_1_fk')->references('id')->on('publicacoes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('autor_id', 'livros_2_fk')->references('id')->on('autores')->onUpdate('cascade')->onDelete('restrict');
        });
        Schema::table('revistas', function (Blueprint $table) {
            $table->foreign('publicacao_id', 'revistas_1_fk')->references('id')->on('publicacoes')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->foreign('user_id', 'users_1_fk')->references('id')->on('pessoas')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publicacoes', function (Blueprint $table) {
            $table->dropForeign('publicacoes_1_fk');
        });
        Schema::table('livros', function (Blueprint $table) {
            $table->dropForeign('livros_1_fk');
            $table->dropForeign('livros_2_fk');
        });
        Schema::table('revistas', function (Blueprint $table) {
            $table->dropForeign('revistas_1_fk');
        });
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->dropForeign('users_1_fk');
        });
    }
}
