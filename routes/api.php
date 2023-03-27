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

Route::get('sheet', 'App\Http\Controllers\GoogleSheetController@index');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@register');
    
    Route::group([
      'middleware' => 'auth:api'
    ], function() {

        Route::prefix('video')->group(function () {
            Route::get('listVideo', 'App\Http\Controllers\VideoController@list');

            Route::get('findVideo/{id}', 'App\Http\Controllers\VideoController@find');

            Route::post('upload-file', 'App\Http\Controllers\VideoController@uploadVideo');

            Route::post('updateVideo/{id}', 'App\Http\Controllers\VideoController@update');

            Route::delete('deleteVideo/{id}', 'App\Http\Controllers\VideoController@delete');

        });
        
        Route::prefix('category')->group(function () {

            Route::post('createCategory', 'App\Http\Controllers\CategoryController@create');

            Route::get('listCategory', 'App\Http\Controllers\CategoryController@list');

            Route::get('findCategory/{id}', 'App\Http\Controllers\CategoryController@find');

            Route::put('updateCategory/{id}', 'App\Http\Controllers\CategoryController@update');

            Route::delete('deleteCategory/{id}', 'App\Http\Controllers\CategoryController@delete');

            Route::get('videoOfCategory/{id}', 'App\Http\Controllers\CategoryController@videoOfCategory');
            
        });
        

        Route::get('listUser', 'App\Http\Controllers\UserController@list');

        Route::get('me/logout', 'App\Http\Controllers\AuthController@logout');

        
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
