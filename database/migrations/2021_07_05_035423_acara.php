<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Acara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_acara', function (Blueprint $table) {
            $table->id();
            $table->integer('id_group');
            $table->string('name');
            $table->string('dimana');
            $table->text('deskripsi');
            $table->date('waktu_awal');
            $table->date('waktu_akhir')->nullable();
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::drop('tb_acara');
    }
}
