<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function showComments(){
        return Comment::all();
    }

    public function showComment($p_id, $c_id){
        $comment = Comment::findOrFail($c_id);
        $post = Post::findOrFail($p_id);
        if($comment->post_id != $post->id){
            return response()->json(['Error'=>'El comentario no pertenece al post'], 200);
        }
        return response()->json(['Post'=>$post,'Comment'=>$comment], 200);
    }
    
    public function createComment(Request $request, $id)
    {
        //reglas de validación
        $reglas = [
            'content' => 'required',
        ];
        //validador
        $validador = \Validator::make($request->all(), $reglas);
        if($validador->fails()){
            return response()->json(['Unacceptable' => 'Llena los campos del post'], 406);
        }
        $comment = Comment::create([
            'content' => $request->content,
            'post_id' => $id,
            'user_id' => $request->user()->id
        ]);
        return response()->json(['Post' => $comment->post()->get(),'Comment' => $comment], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $p_id, $c_id)
    {
        $post = Post::findOrFail($p_id);
        if(is_null($request->input('content'))){
            return response()->json(['error' => 'No se insertaron datos para actualizar el comentario'], 406);
        }
        $comment = Comment::findOrFail($c_id);        
        $comment->content = $request->input('content');
        $comment->save();
        return response()->json(['Post' => $post, 'Comment' => $comment], 200);
    }

    public function delete($id){
        $comment = Comment::findOrFail($id);
        $nom = $comment->content;
        $comment->delete();
        return 'El comentario "'.$nom.'" fue eliminado satisfactoriamente';    
    }
}
