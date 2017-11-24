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
      return view('home',['posts'=>\App\Post::paginate(5)]);
});
Route::get('/documentos/{procedure}','ProcedureController@view' );


Route::get('/publishfinish','ProcedureController@publishfinish' );
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/procedures/text/{procedure}','ProcedureController@text' );
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/procedure/details/{procedure}', 'ProcedureController@details');
    Route::get('/procedure/detail/{procedure}','ProcedureController@detail');
    Route::get('/post/{post}', 'PostController@show');
    Route::post('/procedures/{procedure}', 'ProcedureController@update');
    Route::resource('/suggestions', 'SuggestionController');
    Route::resource('/categories', 'CategoryController');
});
Route::group(['middleware' => ['can:admin']], function () {
    Route::get('/procedure/notification/{procedure}','ProcedureController@notification');
    Route::put('/procedure/state/{procedure}', 'ProcedureController@state');
    Route::post('/procedures/text/{procedure}','ProcedureController@savetext');
    Route::post('/post/{post}', 'PostController@update');
    Route::resource('/users', 'UserController');
    Route::resource('/post', 'PostController');
    Route::resource('/procedures', 'ProcedureController');
});

Route::get('/post/{post}','PostController@show');