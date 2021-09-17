<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/asana/login', '\App\Http\Controllers\AsanaController@index')->name('home');
Route::get('/asana/callback', '\App\Http\Controllers\AsanaController@callback')->name('asana.callback');
Route::get('/asana/main', '\App\Http\Controllers\AsanaController@main')->name('asana.main');
Route::get('/asana/projects/{id}', '\App\Http\Controllers\AsanaController@projects')->name('asana.projects');




Route::get('/', function () {
    return view('welcome');
});
