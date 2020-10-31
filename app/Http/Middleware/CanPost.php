<?php

namespace App\Http\Middleware;

use Closure;

class CanPost
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
        if($request->user()->tokenCan('user:post')){
            return $next($request);
        }
        return response()->json(['Unauthorized' => 'No tienes permiso para postear'], 401);
    }
}
