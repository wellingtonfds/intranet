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
    return redirect('login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/procedures/{procedure}', 'ProcedureController@update');
Route::get('/procedure/details/{procedure}', 'ProcedureController@details');


Route::resource('/suggestions', 'SuggestionController');
Route::resource('/categories', 'CategoryController');


Route::group(['middleware' => ['can:admin']], function () {
    Route::put('/procedure/state/{procedure}', 'ProcedureController@state');
    Route::get('/procedure/notification/{procedure}','ProcedureController@notification');
    Route::resource('/users', 'UserController');
    Route::resource('/procedures', 'ProcedureController');
});