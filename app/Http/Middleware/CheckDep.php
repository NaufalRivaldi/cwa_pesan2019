<?php

namespace App\Http\Middleware;

use Closure;

class CheckDep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$dep)
    {
        if(in_array($request->user()->dep, $dep)){
            return $next($request);
        }

        return redirect('/admin/inbox');
    }
}
