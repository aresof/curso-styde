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

Route::get('/usuarios', function(){
    return "Usuarios";
});


Route::get('/usuario/{id}', function($id){
    return "Usuario: {$id}";
});

Route::get('/usuario/{id}/edit', function($id){
    return "Edición Usuario: {$id}";
})->where('id','[0-9]+');
