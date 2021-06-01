<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rice_fields', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->integer('harga');
            $table->integer('luas');
            $table->text('alamat');
            $table->string('maps');
            $table->text('deskripsi')->nullable();
            $table->enum('sertifikasi', ['shm', 'sgb', 'adat', 'lainnya'])->default('shm');
            $table->enum('tipe', ['jual', 'sewa'])->default('jual');
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
        Schema::dropIfExists('rice_fields');
    }
}
