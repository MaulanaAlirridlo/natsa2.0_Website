<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVestigeIdToRiceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rice_fields', function (Blueprint $table) {
            $table->foreignId('vestige_id')
                ->constrained('vestiges')
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
            $table->dropColumn('vestige_id');
        });
    }
}
