<?php

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



Auth::routes();

Route::get('/verifica-email',[
    'as'    => 'verifyEmail',
    'uses'  => 'Auth\RegisterController@verifyEmail'
]);

Route::get('/email-verificata/{token}',[
    'as'    => 'verification',
    'uses'  => 'Auth\RegisterController@verification'
]);

Route::group(['middleware' => ['auth']],function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', 'HomeController@index')->name('home');
});

