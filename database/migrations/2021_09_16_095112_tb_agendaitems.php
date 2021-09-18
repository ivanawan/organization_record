<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbAgendaitems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_agendaitems', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_agenda');
            $table->string('step');
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
        schema::drop('tb_agendaitems');
    }
}
