<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AvailableEmail
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
        $user = User::where('email', $request->email)->first();
        if(is_object($user)){
            return response()->json(['Error'=>'Email no valido'], 406);
        }
        return $next($request);
    }
}
