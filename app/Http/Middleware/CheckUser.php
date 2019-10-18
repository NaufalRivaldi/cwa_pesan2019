<?php

namespace App\Http\Middleware;
use Session;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $user)
    {
        if($user == Session::get('username')){
            return $next($request);
        }

        return redirect('/backend');
    }
}
