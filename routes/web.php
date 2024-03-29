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

Route::get('/search.html', 'IndexController@indexSearch');
Route::get('/', 'IndexController@index');

Route::get('/send', 'IndexController@send');
Route::get('/login', 'IndexController@login');
Route::get('/logout', 'IndexController@logout');
Route::get('/search', 'IndexController@search');