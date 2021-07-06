<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Anggota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        Schema::create('tb_anggota', function (Blueprint $table) {
        $table->id();
        $table->string('id_group')->nullable();
        $table->integer('id_user');
        $table->integer('role')->nullable();
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
        Schema::dropIfExists('tb_anggota');
    }
}
