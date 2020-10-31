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

Route::get('post', 'PostController@showPosts');
Route::get('post/{id}', 'PostController@showPost')->where('id', '[0-9]+');
Route::get('post/{id}/comments', 'PostController@showComments')->where('id', '[0-9]+');
Route::get('post/{p_id}/comments/{c_id}', 'CommentController@showComment')->where(['ip_d' => '[0-9]+', 'c_id' => '[0-9]+']);

Route::delete('post/{id}', 'PostController@delete')->where('id', '[0-9]+');
Route::delete('post/{p_id}/comments/{c_id}', 'CommentController@delete')->where(['ip_d' => '[0-9]+', 'c_id' => '[0-9]+']);

Route::post('post', 'PostController@createPost');
Route::post('post/{id}/comments', 'CommentController@createComment')->where('id', '[0-9]+');

Route::put('post/{id}', 'PostController@update')->where('id', '[0-9]+');
Route::put('post/{p_id}/comments/{c_id}', 'CommentController@update')->where(['ip_d' => '[0-9]+', 'c_id' => '[0-9]+']);

Route::get('comments', 'CommentController@showComments');
/*
Route::get('comment', 'CommentController@index');
Route::get('post/{p_id}/comment', 'CommentController@show')->where('p_id', '[0-9]+');
Route::delete('post/{id}', 'PostController@destroy')->where('id', '[0-9]+');
Route::post('post', 'PostController@store');
Route::put('post/{id}', 'PostController@update')->where('id', '[0-9]+');
*/