<?php

namespace Database\Seeders;

use App\Models\Vestige;
use Illuminate\Database\Seeder;

class VestigeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vestige::insert([
            ['vestige' => 'Padi'],
            ['vestige' => 'Gandum'],
            ['vestige' => 'Cabai'],
            ['vestige' => 'Jagung'],
            ['vestige' => 'Tebu'],
        ]);
    }
}
