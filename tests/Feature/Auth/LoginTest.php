<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_example()
    {
        // Kita memiliki 1 user terdaftar
        $user = User::create([
            'name' => 'budi',
            'email' => 'username@example.net',
            'email_verified_at' => now(),
            'username' => 'budi',
            'ktp' => Str::random(16),
            'password' => bcrypt('secret'), // password
            'remember_token' => Str::random(10),
        ]);
        // $user = factory(User::class)->makes();
        if (!$user){
            $this->assertTrue(false);
        }
        $this->assertTrue(true);
    }
}
