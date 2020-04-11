<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['reset' => false, 'password.request' => false]);

Route::group([
    "middleware" => ['auth']
], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group([
        "prefix" => "elans"
    ], function() {
        Route::get('/', 'ElanController@index')->name('elan__index');
        Route::get('/create', 'ElanController@create')->name('elan__create');
        Route::post('/store', 'ElanController@store')->name('elan__store');
        Route::get('/{id}', 'ElanController@show')->name('elan__show');
        Route::post('/delete/{id}', 'ElanController@destroy')->name('elan__destroy');
    });
    Route::group([
        "prefix" => "chat"
    ], function() {
        Route::get('/', 'ChatController@index')->name('chat__index');
        Route::get('/create', 'ChatController@create')->name('chat__create');
        Route::post('/store', 'ChatController@store')->name('chat__store');
        Route::get('/{id}', 'ChatController@show')->name('chat__show');
        Route::post('/delete/{id}', 'ChatController@destroy')->name('chat__destroy');
    });
    Route::group([
        "prefix" => "factor"
    ], function() {
        Route::get('/', 'FactorController@index')->name('factor__index');
        Route::get('/create', 'FactorController@create')->name('factor__create');
        Route::post('/store', 'FactorController@store')->name('factor__store');
//        Route::get('/edit/{id}', 'FactorController@edit')->name('factor__edit');
//        Route::post('/update/{id}', 'FactorController@update')->name('factor__update');
        Route::get('/{id}', 'FactorController@show')->name('factor__show');
        Route::post('/delete{id}', 'FactorController@destroy')->name('factor__destroy');
    });

    Route::group([
        "prefix" => "factor-mostajer"
    ], function() {
        Route::get('/edit/{id}', 'MostajerFactorController@edit')->name('factor-mostajer__edit');
        Route::post('/update/{id}', 'MostajerFactorController@update')->name('factor-mostajer__update');
    });

    Route::group([
        "prefix" => "mostajers"
    ], function() {
        Route::get('/', 'MostajerController@index')->name('mostajer__index');
        Route::get('/create', 'MostajerController@create')->name('mostajer__create');
        Route::post('/store', 'MostajerController@store')->name('mostajer__store');
//        Route::get('/{id}', 'ChatController@show')->name('chat__show');
//        Route::post('/delete/{id}', 'ChatController@destroy')->name('chat__destroy');
    });
});
