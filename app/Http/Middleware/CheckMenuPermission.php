<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMenuPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $menu=NULL)
    {
        if(is_null($menu)){
            return $next($request);
        }
        if(auth()->user()->hasMenuPermission($menu)) {
            return $next($request);
        }
        abort(403);
    }
}
