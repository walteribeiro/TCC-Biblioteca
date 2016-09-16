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
            $table->foreign('user_id', 'funcionarios_1_fk')->references('id')->on('pessoas')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('alunos', function (Blueprint $table) {
            $table->foreign('user_id', 'alunos_1_fk')->references('id')->on('pessoas')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('data_shows', function (Blueprint $table) {
            $table->foreign('recurso_id', 'data_shows_1_fk')->references('id')->on('recursos')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('mapas', function (Blueprint $table) {
            $table->foreign('recurso_id', 'mapas_1_fk')->references('id')->on('recursos')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('salas', function (Blueprint $table) {
            $table->foreign('recurso_id', 'salas_1_fk')->references('id')->on('recursos')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('reserva_recursos', function (Blueprint $table) {
            $table->foreign('funcionario_id', 'reserva_recursos_1_fk')->references('id')->on('funcionarios')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('recurso_id', 'reserva_recursos_2_fk')->references('id')->on('recursos')->onUpdate('cascade')->onDelete('restrict');
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
            $table->dropForeign('funcionarios_1_fk');
        });
        Schema::table('alunos', function (Blueprint $table) {
            $table->dropForeign('alunos_1_fk');
        });
        Schema::table('data_shows', function (Blueprint $table) {
            $table->dropForeign('data_shows_1_fk');
        });
        Schema::table('mapas', function (Blueprint $table) {
            $table->dropForeign('mapas_1_fk');
        });
        Schema::table('salas', function (Blueprint $table) {
            $table->dropForeign('salas_1_fk');
        });
        Schema::table('reserva_recursos', function (Blueprint $table) {
            $table->dropForeign('reserva_recursos_1_fk');
            $table->dropForeign('reserva_recursos_2_fk');
        });
    }
}
