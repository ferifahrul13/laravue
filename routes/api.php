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

Route::namespace('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('auth')->group(function () {
            //dibawah ini adalah route publik, semua bisa mengakses

            //Membuat User Baru
            Route::post('register', 'AuthController@register');

            // Login User
            Route::post('login', 'AuthController@login');

            // Refresh JWT Token
            Route::get('refresh', 'AuthController@refresh');

            //Dibawah ini hanya bisa diakses oleh user yang ter autentifikasi

            // Logout user dari aplikasi
            Route::post('logout', 'AuthController@logout')->middleware('auth:api');
        });

        Route::middleware('auth:api')->group(function () {
            Route::apiResource('user', 'UserController');
        });
    });
});
