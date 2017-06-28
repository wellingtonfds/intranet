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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/categories','CategoryController');
Route::post('/procedures/{procedure}','ProcedureController@update');
Route::resource('/procedures','ProcedureController');
Route::get('/procedure/details/{procedure}','ProcedureController@details');
Route::put('/procedure/state/{procedure}','ProcedureController@state');
