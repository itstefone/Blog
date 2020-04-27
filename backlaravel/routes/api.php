<?php

use App\Http\Controllers\CategoryController;
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



Route::get('/categories', 'CategoryController@index');

Route::get('/posts', 'PostController@index');

Route::post('/auth/create', 'AuthController@store');



Route::post('/auth/login', 'AuthController@login');
Route::get('/proba', 'AuthController@proba');


Route::group(['middleware' => 'auth:api'], function(){

  
Route::get('/refresh', 'AuthController@refresh');

Route::get('/logout', 'AuthController@logout');
Route::post('/image/upload', 'ImageController@uploadProfileImage');

Route::post('/user/update', 'AuthController@update');


Route::post('/post/create', 'PostController@store');


});