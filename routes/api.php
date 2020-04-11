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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    "prefix" => "auth"
], function() {
    Route::post('/login', 'Auth\LoginController@apiLogin');
    Route::group([
        "middleware" => ['jwt.verify']
    ], function() {
        Route::post('/logout', 'Auth\LoginController@apiLogout');
        Route::get('/me', 'MostajerController@me');
    });
});

Route::group([
    "middleware" => ['jwt.verify']
], function() {
    Route::get('/home', 'HomeController@home');
    Route::get('/factors', 'FactorController@personIndex');
    Route::get('/elans', 'ElanController@personIndex');

    Route::post('/chat', 'ChatController@store');
});