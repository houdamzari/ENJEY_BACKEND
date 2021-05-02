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

// LOGIN APIS
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
Route::post('/register', 'AuthController@register');
Route::get('/user', 'AuthController@user');


Route::group(['prefix' => 'client', 'middleware' => 'auth'], function () {
    // USERS APIS
    Route::get('/users', 'AuthController@index');
    Route::patch('/users/{user}', 'AuthController@update');
    // RECLAMATION APIS
    Route::post('/rec', 'ReclamationController@store')->middleware('auth:api');
    Route::get('/rec', 'ReclamationController@index');
    Route::get('/rec/{rec}', 'ReclamationController@show');
    Route::patch('/rec/{rec}', 'ReclamationController@update')->middleware('auth:api');
    Route::delete('/rec/{rec}', 'ReclamationController@destroy')->middleware('auth:api');
    // CONSOMATION APIS
    Route::post('/conso', 'ConsomationController@store')->middleware('auth:api');
    Route::get('/conso', 'ConsomationController@index');
    Route::get('/conso/{conso}', 'ConsomationController@singleconso');
    Route::get('/conso/{conso}', 'ConsomationController@show');
    Route::patch('/conso/{conso}', 'ConsomationController@update')->middleware('auth:api');
    Route::delete('/conso/{conso}', 'ConsomationController@destroy')->middleware('auth:api');
});
