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

Route::get('/', 'TaskController@show');
Route::get('/addpost', 'TaskController@addpost');
Route::match(['get', 'post'], '/edit/{id?}', 'TaskController@edit');
Route::match(['get', 'post'], '/showlist', 'TaskController@showlist');
Route::match(['get', 'post'], '/update', 'TaskController@update');
Route::match(['get', 'post'], '/delete', 'TaskController@delete');
Route::match(['get', 'post'], '/insert', 'TaskController@insert');