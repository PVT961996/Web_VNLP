<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleWare extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check() && Auth::user()->group_id == 1 && Auth::user()->confirmed == 1)
            return $next($request);
        else{
            $this->authenticate($guards);
            return redirect('/');
        }
    }
}
