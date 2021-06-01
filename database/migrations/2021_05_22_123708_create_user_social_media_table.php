<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_social_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('social_media_id')
                ->constrained('social_media')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('link', 100);
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
        Schema::dropIfExists('user_social_media');
    }
}
