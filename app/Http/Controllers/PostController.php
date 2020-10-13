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
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //reglas de validación
        $reglas = [
            'title' => 'required',
            'body' => 'required'
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
    public function show($id)
    {
        return Post::findOrFail($id);
    }
    public function showComment($p_id, $c_id)
    {
        return Post::findOrFail($p_id)->comments->where('id', $c_id);
    }
    public function showComments($id)
    {
        return Post::findOrFail($id)->comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
            return 'No hay valores a actualizar para el post "'.$nom.'"';
        }

        if(is_null($request->input('title'))){
            $nom = $post->title;
            $post->body = $request->input('body');
            $post->save();
            return 'Se actualizó de manera exitosa el contenido del post "'.$nom.'"';
        }
        else if(is_null($request->input('body'))){
            $nom = $post->title;
            $post->title = $request->input('title');
            $post->save();
            return 'El titulo del post '.$nom.' actualizado de manera exitosa a '.$post->title;
        }
        else{
            $nom = $post->title;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();
            return 'Los datos del post "'.$nom.'" se han actualizado de manera exitosa';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $nom = $post->title;
        $post->delete();
        return 'El post "'.$nom.'" fue eliminado satisfactoriamente';
    }
    public function destroyComment($p_id, $c_id)
    {
        Post::findOrFail($p_id)->comments()->where('id', $c_id)->delete();
        return 'El comentario fue eliminado satisfactoriamente';
    }
}
