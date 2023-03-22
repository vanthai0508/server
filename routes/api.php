<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route::post('signup', 'App\Http\Controllers\AuthController@signup');
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@register');
    
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('listUser', 'App\Http\Controllers\UserController@list');
        Route::get('me/logout', 'App\Http\Controllers\AuthController@logout');
        Route::post('upload-file', 'App\Http\Controllers\VideoController@uploadVideo');
        Route::get('listVideo', 'App\Http\Controllers\VideoController@list');
        Route::post('createCategory', 'App\Http\Controllers\CategoryController@create');
        Route::get('listCategory', 'App\Http\Controllers\CategoryController@list');

        Route::get('findVideo/{id}', 'App\Http\Controllers\VideoController@find');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
