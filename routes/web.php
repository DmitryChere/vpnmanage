<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'MainController@index');
Route::get('/generate', 'MainController@generate');
Route::get('/report/{offset?}', 'MainController@report');

Route::post('/company/add/{id?}/{view?}', 'CompanyController@manage');
Route::post('/company/edit/{id?}/{view?}', 'CompanyController@manage');
Route::post('/company/remove/{id}', 'CompanyController@remove');
Route::post('/user/add/{id?}/{view?}', 'UserController@manage');
Route::post('/user/edit/{id?}/{view?}', 'UserController@manage');
Route::post('/user/remove/{id}', 'UserController@remove');
