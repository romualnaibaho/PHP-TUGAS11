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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getData', 'Tugas12Controller@getData');
Route::post('/pushData', 'Tugas12Controller@store');
Route::post('/setData', 'Tugas12Controller@update');
Route::get('/delete/{id}', 'Tugas12Controller@hapus');
Route::get('/getDetail/{id}', 'Tugas12Controller@getDetail');
