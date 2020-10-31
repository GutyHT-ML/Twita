<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Grant;

class AssignGrants
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
        $response = $next($request); 
        $user = User::where('email', $request->email)->first();
        
        Grant::create([
            'user_id'=>$user->id,
            'abilities'=>'user:perfil'
        ]);
        Grant::create([
            'user_id'=>$user->id,
            'abilities'=>'user:info'
        ]);
        return $response;
    }
}
