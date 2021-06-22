<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        //validasi data
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:150'],
            'password' => ['required','max:13'],
        ]);

        //cek user
        $user = User::where('email', $request->email)->first();
    
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'massage' => 'Bad Credentials'
            ], 401);
        }

        //buat token untuk user
        $token = $user->createToken($user->id . '-AppToken', [
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
