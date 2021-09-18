<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_agenda', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_group');
            $table->string('name');
            $table->text('desc');
            $table->timestime();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::drop('tb_agenda');
    }
}
