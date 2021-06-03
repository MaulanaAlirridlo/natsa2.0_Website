<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiceFieldPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rice_field_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rice_field_id')
                ->constrained('rice_fields')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('photo_path');
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
        Schema::dropIfExists('rice_field_photos');
    }
}
