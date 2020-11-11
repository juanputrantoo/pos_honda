<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
class Admin
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
        if(Auth::check() && Auth::user()->role == 1){
            // $now = date('Y-m-d H:i:s');
            // Auth::user()->setAttribute('last_login', $now)->save();
            return $next($request);
        }

        return abort(503, 'Anda tidak memiliki hak akses');
    }
}
