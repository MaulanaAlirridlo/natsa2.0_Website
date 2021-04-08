<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrigasiSawahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irigasi_sawah', function (Blueprint $table) {
            $table->string('id_irigasi_sawah', 8);
            $table->string('nama_irigasi_sawah', 50);
            $table->timestamps();
            $table->primary('id_irigasi_sawah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irigasi_sawah');
    }
}
