<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBekasSawahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bekas_sawah', function (Blueprint $table) {
            $table->string('id_bekas_sawah', 8);
            $table->string('nama_bekas_sawah', 20);
            $table->timestamps();
            $table->primary('id_bekas_sawah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bekas_sawah');
    }
}
