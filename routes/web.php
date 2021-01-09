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

Route::get('/', 'HomeController@index');
Route::get('auteur', 'HomeController@auteur');
Route::get('page/{id}', 'HomeController@page');
Route::get('contact', 'HomeController@contact');
Route::get('colloque', 'HomeController@colloque');
Route::get('archive', 'HomeController@archive');
Route::get('jurisprudence', 'HomeController@jurisprudence');
Route::get('campagne/{id?}', 'HomeController@campagne');
Route::post('sendMessage', 'HomeController@sendMessage');
Route::get('pdf/{id}', 'HomeController@pdf');

Route::post('updateCache', 'HomeController@updateCache');