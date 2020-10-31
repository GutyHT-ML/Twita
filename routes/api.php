<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', 'UserController@index');
Route::middleware('auth:sanctum')->delete('/logout', 'UserController@logOut');

Route::post('/signin','UserController@signIn')->middleware('email', 'grant');
Route::post('/login','UserController@logIn');

Route::post('/user/{id}/grant/{ab}', 'UserController@grant')->where(['id' => '[0-9]+', 'ab' => '[a-z]+'])->middleware('auth:sanctum', 'admin');
Route::delete('/user/{id}/revoke/{ab}', 'UserController@revoke')->where(['id' => '[0-9]+', 'ab' => '[a-z]+'])->middleware('auth:sanctum', 'admin');

Route::get('/post', 'PostController@showPosts');
Route::get('/post/{id}', 'PostController@showPost')->where('id', '[0-9]+');
Route::get('/post/{id}/comments', 'PostController@showComments')->where('id', '[0-9]+');
Route::get('/post/{p_id}/comments/{c_id}', 'CommentController@showComment')->where(['ip_d' => '[0-9]+', 'c_id' => '[0-9]+']);

Route::delete('/post/{id}', 'PostController@delete')->where('id', '[0-9]+')->middleware('auth:sanctum', 'delete');
Route::delete('/post/{p_id}/comments/{c_id}', 'CommentController@delete')->where(['ip_d' => '[0-9]+', 'c_id' => '[0-9]+'])->middleware('auth:sanctum', 'delete');

Route::post('/post', 'PostController@createPost')->middleware('auth:sanctum', 'postcomment');
Route::post('/post/{id}/comments', 'CommentController@createComment')->where('id', '[0-9]+')->middleware('auth:sanctum', 'postcomment');

Route::put('/post/{id}', 'PostController@update')->where('id', '[0-9]+')->middleware('auth:sanctum', 'edit');
Route::put('/post/{p_id}/comments/{c_id}', 'CommentController@update')->where(['ip_d' => '[0-9]+', 'c_id' => '[0-9]+']) ->middleware('auth:sanctum', 'edit');

Route::get('/comments', 'CommentController@showComments');
/*
Route::get('comment', 'CommentController@index');
Route::get('post/{p_id}/comment', 'CommentController@show')->where('p_id', '[0-9]+');
Route::delete('post/{id}', 'PostController@destroy')->where('id', '[0-9]+');
Route::post('post', 'PostController@store');
Route::put('post/{id}', 'PostController@update')->where('id', '[0-9]+');
*/