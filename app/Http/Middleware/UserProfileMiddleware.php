<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\User;

class UserProfileMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {            
        abort_if(auth()->user()->username != $request->route('id'), 403);
        
        return $next($request);
    }
}
