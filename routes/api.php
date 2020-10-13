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
Route::get('post', 'PostController@index');
Route::get('post/{id}', 'PostController@show')->where('id', '[0-9]+');
Route::get('post/{id}/comment', 'PostController@showComments')->where('id', '[0-9]+');
Route::get('post/{p_id}/comment/{c_id}', 'PostController@showComment')->where(['ip_d' => '[0-9]+', 'c_id' => '[0-9]+']);
Route::delete('post/{id}', 'PostController@destroy')->where('id', '[0-9]+');
Route::delete('post/{p_id}/comment/{c_id}', 'PostController@destroyComment')->where(['ip_d' => '[0-9]+', 'c_id' => '[0-9]+']);
Route::post('post', 'PostController@store');
Route::put('post/{id}', 'PostController@update')->where('id', '[0-9]+');

Route::get('comments', 'CommentController@index');
/*
Route::get('comment', 'CommentController@index');
Route::get('post/{p_id}/comment', 'CommentController@show')->where('p_id', '[0-9]+');
Route::delete('post/{id}', 'PostController@destroy')->where('id', '[0-9]+');
Route::post('post', 'PostController@store');
Route::put('post/{id}', 'PostController@update')->where('id', '[0-9]+');
*/