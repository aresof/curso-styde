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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', 'UserController@index')
    ->name('users');

Route::get('/usuario/{user}', 'UserController@show')
    ->where('user','[0-9]+')
    ->name('users.show');

Route::get('/usuario/nuevo', 'UserController@create')
    ->name('users.create');

Route::post('/usuario/crear', 'UserController@store');

Route::get('/usuario/{user}/edit', 'UserController@edit')
    ->where('id','[0-9]+')
    ->name('users.edit');

Route::put('/usuario/{user}', 'UserController@update');

Route::get('/saludo/{name}', 'WelcomeUserController@saludo_simple');
Route::get('/saludo/{name}/{nickname}', 'WelcomeUserController@saludo_compuesto');

Route::delete('/usuario/{user}', 'UserController@destroy')
    ->name('users.destroy');
