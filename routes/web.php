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
Route::resource('/task','Taskcontroller');
Route::resource('/product','Productcontroller');

//list single task
Route::get('task/{id}', 'TaskController@show');
//create  new task
Route::post('task','TaskController@store');

//update task
Route::put('Tasks','TaskController@store');

//delete task
Route::delete('tasks','TaskController@destroy');

//list single product
Route::get('product/{id}', 'Productcontroller@show');