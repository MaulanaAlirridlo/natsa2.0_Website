<?php

namespace Database\Seeders;

use App\Models\Irrigation;
use Illuminate\Database\Seeder;

class IrrigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Irrigation::insert([
            [ 'irrigation' => 'Permukaan'],
            [ 'irrigation' => 'Bawah permukaan'],
            [ 'irrigation' => 'Pancaran'],
            [ 'irrigation' => 'Irigasi pompa air'],
            [ 'irrigation' => 'Ember atau timba'],
            [ 'irrigation' => 'Tetes'],
        ]);
    }
}
