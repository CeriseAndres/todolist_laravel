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

Route::get('mes-listes/{id}', 'TodolistsController@userIndex')->middleware('auth')->name('show_todolists');
//Route::get('nouvelle-liste', 'TodolistsController@create');
Route::post('mes-listes/{id}', 'TodolistsController@store')->middleware('auth')->name('add_todolist');
Route::delete('mes-listes/{todolist_id}', 'TodolistsController@destroy')->middleware('auth')->name('delete_todolist');


Route::get('mes-taches/{id}', 'TodoactionsController@todolistIndex')->name('show_todoactions');

//Essai Destroy par Api :{
Route::namespace('Api')->get('api/users/{user}/destroy', 'Api\UserController@destroyForm');

