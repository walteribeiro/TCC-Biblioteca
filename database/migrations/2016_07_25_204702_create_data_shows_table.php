<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_shows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marca')->nullable();
            $table->integer('codigo')->unique();
            $table->unsignedBigInteger('recurso_id')->index('recurso_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('data_shows');
    }
}
