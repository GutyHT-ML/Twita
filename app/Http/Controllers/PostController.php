<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPosts()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPost(Request $request)
    {
        //reglas de validación
        $reglas = [
            'title' => 'required',
            'body' => 'required',
            'user_id' =>'required'
        ];
        //validador
        $validador = \Validator::make($request->all(), $reglas);
        if($validador->fails()){
            return 'Llena los campos para tu post';
        }
        Post::create($request->all());
        return 'El post "'.$request->body.'" fue creado exitosamente';        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function showPost($id)
    {
        return Post::findOrFail($id);
    }
    public function showComments($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments;
        return response()->json(['Post' => $post], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if(is_null($request->input('body'))&&is_null($request->input('title'))){
            $nom = $post->title;
            $post->save();
            $str ='No hay valores a actualizar para el post "'.$nom.'"';
            return response()->json($str, 200);
        }

        if(is_null($request->input('title'))){
            $nom = $post->title;
            $post->body = $request->input('body');
            $post->save();
            $str = 'Se actualizó de manera exitosa el contenido del post "'.$nom.'"';
            return response()->json($str, 200);
        }
        else if(is_null($request->input('body'))){
            $nom = $post->title;
            $post->title = $request->input('title');
            $post->save();
            $str = 'El titulo del post '.$nom.' actualizado de manera exitosa a '.$post->title;
            return response()->json($str, 200);
        }
        else{
            $nom = $post->title;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();
            $str = 'Los datos del post "'.$nom.'" se han actualizado de manera exitosa';
            return response()->json($str, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $nom = $post->title;
        $post->delete();
        $str = 'El post "'.$nom.'" fue eliminado satisfactoriamente';
        return response()->json($str, 200);
    }
}
