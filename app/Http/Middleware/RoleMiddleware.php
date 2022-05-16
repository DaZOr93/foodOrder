<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role, $role2=null)
    {

        if (auth()->user()->role_id == $role) {
            return $next($request);
        }
        if($role2 !==null){
            if (auth()->user()->role_id == $role2) {
                return $next($request);
            }
        }
        abort(404);
    }
}
