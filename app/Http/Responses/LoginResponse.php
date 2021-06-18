<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        
        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
        
        // return $request->wantsJson()
        //             ? response()->json(['two_factor' => false])
        //             : redirect()->intended(config('fortify.home'));

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'dev') {
            return redirect()->route('dashboard');
        }

        return redirect()->intended(config('fortify.home'));
    }

}