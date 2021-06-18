<?php

namespace Database\Seeders;

use App\Models\Verification;
use Illuminate\Database\Seeder;

class VerificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Verification::insert([
            [
                'verification_type' => 'Bronze',
                'desc' => 'Tipe Bronze'
            ],
            [
                'verification_type' => 'Silver',
                'desc' => 'Tipe Silver'
            ],
            [
                'verification_type' => 'Platinum',
                'desc' => 'Tipe Platinum'
            ],
            [
                'verification_type' => 'Gold',
                'desc' => 'Tipe Gold'
            ]

        ]);
    }
}
