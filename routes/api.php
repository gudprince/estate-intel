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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/external-books', 'App\Http\Controllers\Api\BookController@external_books');
Route::post('/v1/books', 'App\Http\Controllers\Api\BookController@create');
Route::get('/v1/books', 'App\Http\Controllers\Api\BookController@index');
Route::delete('/v1/books/{id}', 'App\Http\Controllers\Api\BookController@destroy');
Route::get('/v1/books/{id}', 'App\Http\Controllers\Api\BookController@show');
Route::put('/v1/books/{id}', 'App\Http\Controllers\Api\BookController@update');
