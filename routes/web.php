<?php

Route::get('/info',function (){
   phpinfo();
});
Route::get('/', 'HomeController@initial');
Route::get('/centro-de-custo/{choice}', 'HomeController@centerOfCost');
Route::get('/documentos/{procedure}','ProcedureController@view' );
Route::get('/publishfinish','ProcedureController@publishfinish' );
Route::post('/login/ldap','Auth\LoginController@loginLdap');

Auth::routes();
Route::resource('/document', 'PatternController');
Route::group(['middleware' => ['can:admin']], function () {
    Route::get('/procedure/notification/{procedure}','ProcedureController@notification');
    Route::put('/procedure/state/{procedure}', 'ProcedureController@state');
    Route::post('/procedures/text/{procedure}','ProcedureController@savetext');
    Route::post('/post/{post}', 'PostController@update');
    Route::resource('/users', 'UserController');
    Route::resource('/post', 'PostController');
    Route::resource('/procedures', 'ProcedureController');
    Route::get('/documents', 'PatternController@listDocuments');
    Route::post('/documents/{document}', 'PatternController@update');

});
Route::get('/documents', 'PatternController@listDocuments');
Route::resource('/categories', 'CategoryController');
Route::resource('/discipline', 'DisciplineController');
Route::get('/discipline/sub/{discipline}', 'DisciplineController@subDiscipline');
Route::get('/discipline/cat/{discipline}/{subDiscipline}', 'DisciplineController@category');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/procedures/text/{procedure}','ProcedureController@text' );
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/procedure/details/{procedure}', 'ProcedureController@details');
    Route::get('/procedure/detail/{procedure}','ProcedureController@detail');
    Route::get('/post/{post}', 'PostController@show');
    Route::post('/procedures/{procedure}', 'ProcedureController@update');
    Route::resource('/suggestions', 'SuggestionController');


});
Route::get('/post/{post}','PostController@show');