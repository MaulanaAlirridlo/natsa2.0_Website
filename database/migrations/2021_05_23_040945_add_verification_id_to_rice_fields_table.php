<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerificationIdToRiceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rice_fields', function (Blueprint $table) {
            $table->foreignId('verification_id')
                ->constrained('verifications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rice_fields', function (Blueprint $table) {
            $table->dropColumn('verification_id');
        });
    }
}
