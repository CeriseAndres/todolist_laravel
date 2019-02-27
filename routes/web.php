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


Route::resource('/users', 'UsersController')->middleware('auth');
Route::resource('/todolists', 'TodolistsController')->middleware('auth');
Route::resource('/todoactions', 'TodoactionsController')->middleware('auth');
Route::resource('/comments', 'TodolistsController')->middleware('auth');

Route::get('mes-listes/{id}', 'TodolistsController@userIndex')->middleware('auth')->name('show_todolists');
Route::post('mes-listes/{id}', 'TodolistsController@store')->middleware('auth')->name('add_todolist');

//Essai Destroy par Api :{
Route::namespace('Api')->get('api/users/{user}/destroy', 'Api\UserController@destroyForm');


Route::get('mes-taches/{id}', 'TodoactionsController@todolistIndex')->name('show_todolist_detail');
Route::get('toutes-mes-taches/{id}', 'TodoactionsController@userIndex')->name('show_todoactions');

