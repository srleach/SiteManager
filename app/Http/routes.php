<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth'], function(){
    // Authentication routes...
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
    // Registration routes...
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

    Route::get('updates', 'UpdateController@getIndex');

    Route::get('/', function () {
        return view('admin.index');
    });
});

/**
 * This is where we'll house the 'god' functions.
 */
Route::group(['prefix' => 'admin/system', 'middleware' => 'auth.superuser'], function(){

    Route::get('updates', 'UpdateController@getIndex');

    Route::get('/', function () {
        return view('admin.index');
    });
});
