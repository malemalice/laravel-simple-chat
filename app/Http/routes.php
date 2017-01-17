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

Route::get('/', 'HomeController@index');
//
// Route::get('login', 'UserController@login');
//
//
// Route::get('/register', function () {
//     return view('register');
// });

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/profile', 'HomeController@profile');
Route::post('/profile/process', 'HomeController@updateProfile');
Route::post('/processStatus', 'HomeController@update');
