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

Route::get('/privacy-policy',function(){
   return view('privacy.info');
})->name('privacy');

Route::get('/termini-di-servizio',function(){
    return view('privacy.termini-di-servizio');
})->name('term');

Route::get('/email-verificata/{token}',[
    'as'    => 'verification',
    'uses'  => 'Auth\RegisterController@verification'
]);

Route::group(['middleware' => ['auth']],function(){
    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/dashboard',[
        'as'            => 'dashboard',
        'uses'          => 'HomeController@index'
    ]);

    /*
    |----------------------------------------------------------------
    | Utenti
    |----------------------------------------------------------------
    */

    Route::get('/profilo',[
        'as'    => 'profilo.index',
        'uses'  => 'Users\UsersController@index'
    ]);

    Route::get('/profilo/create',function(){
        return redirect(route('dashboard'));
    })->name('profilo.create');

    Route::get('/profilo/{id}',[
        'as'    => 'profilo.edit',
        'uses'  => 'Users\UsersController@profilo'
    ]);

    Route::post('/profilo',[
        'as'    => 'profilo.store',
        'uses'  => 'Users\UsersController@profiloStore'
    ]);

    Route::put('/profilo/{id}',[
        'as'    => 'profilo.update',
        'uses'  => 'Users\UsersController@profiloEdit'
    ]);

    Route::resource('users','Users\UsersController');

    /*
    |----------------------------------------------------------------
    | Ruoli
    |----------------------------------------------------------------
    */

    Route::resource('roles','Roles\RolesController');
});

