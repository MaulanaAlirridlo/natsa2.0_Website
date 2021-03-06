<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(!auth()->check()){ return redirect()->route('login'); }

        $user = auth()->user();

        if(auth()->user()->role == $role){ return $next($request); }

        return abort(403);

    }
}
