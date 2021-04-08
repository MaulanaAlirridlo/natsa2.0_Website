<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSawahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sawah', function (Blueprint $table) {
            $table->string('id',24);
            $table->integer('luas');
            $table->integer('harga');
            $table->smallInteger('jumlah_panen');
            $table->text('alamat');
            $table->text('maps');
            $table->text('deskripsi');
            $table->enum('jenis',['jual','sewa']);
            $table->enum('status',['tersedia','tidak tersedia','terjual','tersewa']);
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
        Schema::dropIfExists('sawah');
    }
}
