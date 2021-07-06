<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirect(){

        return Socialite::driver('google')->stateless()->redirect();

    }

    public function callback(){

        $user = Socialite::driver('google')->stateless()->user();
        
        $create = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->nickname,
            'username' => Str::replace(' ', '-', $user->nickname),
            'password' => Hash::make(Str::random(20)),
            'ktp' => Str::limit($user->id, 16, ''),
            'email_verified_at' => now(),
            'no_hp' => '',
        ]);
        
        Auth::login($create);

        return redirect()->route('home');

    }
}
