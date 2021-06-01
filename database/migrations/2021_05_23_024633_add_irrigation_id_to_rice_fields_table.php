<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIrrigationIdToRiceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rice_fields', function (Blueprint $table) {
            $table->foreignId('irrigation_id')
                ->constrained('irrigations')
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
            $table->dropColumn('irrigation_id');
        });
    }
}
