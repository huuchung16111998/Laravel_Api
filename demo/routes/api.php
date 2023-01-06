<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('post', 'App\Http\Controllers\API\PostController@index');
Route::get('post/{id}', 'App\Http\Controllers\API\PostController@postById');
Route::post('post', 'App\Http\Controllers\API\PostController@addRecord');
Route::put('post/{id}', 'App\Http\Controllers\API\PostController@updateRecord');
Route::delete('post/{id}', 'App\Http\Controllers\API\PostController@deleteRecord');

Route::post('register', 'App\Http\Controllers\Api\UserController@userlogin');

