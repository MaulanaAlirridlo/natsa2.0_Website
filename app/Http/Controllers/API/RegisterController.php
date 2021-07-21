<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request, User $user)
    {
        //validasi data
        $this->validate($request, [
            'name' => ['required', 'string', 'max:150', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'username' => ['required', 'string', 'max:50', 'unique:users', 'alpha_dash'],
            'ktp' => ['required', 'numeric', 'digits:16', 'unique:users'],
            'password' => ['required','max:13','confirmed'],
        ]);

        //simpan data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'ktp' => $request->ktp,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        //buat token untuk user
        $token = $user->createToken($user->id.'-AppToken', [
            'create',
            'read',
            'update',
            'delete',
        ])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response()->json($response);
    }
}
