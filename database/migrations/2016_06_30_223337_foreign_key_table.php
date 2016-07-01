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
        //
    }
}
