<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(){
        auth()->user()->tokens()->delete();

        return[
            'message' => "Logged out",
        ];

    }
}
