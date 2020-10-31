<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use App\Comment;

class CanDelete
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
        if(! is_null($request->route('id'))){
            $post = Post::findOrFail($request->route('id'));
            $user = $post->user()->first();
            if($request->user()->tokenCan('user:delete') || $user->id == $post->user_id){
                return $next($request);
            }
            else{
                return response()->json(['Unauthorized' => 'No estas autorizado para eliminar'], 401);
            }
        }
        else{
            $comment = Comment::findOrFail($request->route('c_id'));
            $user = $comment->user()->first();
            if($request->user()->tokenCan('user:delete') || $user->id == $comment->user_id){
                return $next($request);
            }
            else{
                return response()->json(['Unauthorized' => 'No estas autorizado para eliminar'], 401);
            }
        }
    }
}
