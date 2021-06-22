<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RegionSeeder;
use Database\Seeders\VestigeSeeder;
use Database\Seeders\IrrigationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            RegionSeeder::class,
            IrrigationSeeder::class,
            VestigeSeeder::class,
        ]);
    }
}
