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

Route::resource('/users', 'UsersController');
Route::resource('/todolists', 'TodolistsController');
Route::resource('/todoactions', 'TodoactionsController');
Route::resource('/comments', 'TodolistsController');

Route::get('mes-listes/{id}', 'TodolistsController@userIndex')->name('show_todolists');
Route::get('nouvelle-liste', 'TodolistsController@create')->name('add_todolist');
Route::post('nouvelle-liste/{id}', 'TodolistsController@store');


Route::get('mes-taches/{id}', 'TodoactionsController@todolistIndex')->name('show_todoactions');

