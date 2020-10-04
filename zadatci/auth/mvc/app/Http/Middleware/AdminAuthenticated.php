<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminAuthenticated
{
    public function handle($request, Closure $next)
    {
        if( Auth::check() )
        {
            if ( Auth::user()->isUser() ) {
                return response()->view('home');

            }

            else if ( Auth::user()->isAdmin() ) {
                 return $next($request);
            }
        }

        abort(404);
    }
}
