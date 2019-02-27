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

//générer les routes vers les 7 méthodes du contrôleur de ressource
//Route::resource('users', 'UserController');
Route::namespace('Api')->get('api/users/{user}/destroy', 'Api\UserController@destroyForm');
