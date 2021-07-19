<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Keuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_keuangan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_group');
            // $table->string('iden');
            $table->boolean('role');
            $table->text('keterangan')->nullable();
            $table->integer('jumlah');
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
        Schema::dropIfExists('tb_keuangan');
    }
}
