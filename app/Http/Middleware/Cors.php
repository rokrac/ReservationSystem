<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)->header('Access-Control-Allow-Origin','*')
            ->header('Access-Control-Allow','GET,PUT,POST,DELETE,PATCH,OPTIONS')
            ->header('Access-Control-Allow-Header','Content-Type,Authorization,X-CSRF-TOKEN, X-Auth-Token');
    }
}
