<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserAuthenticated
{
    public function handle($request, Closure $next)
    {
        if( Auth::check() )
        {

            if ( Auth::user()->isAdmin() ) {
                return response()->view('welcome');

            }

            else if ( Auth::user()->isUser() ) {
                 return $next($request);
            }
        }

        abort(404);
    }
}
