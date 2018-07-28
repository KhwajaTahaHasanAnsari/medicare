<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//list tasks
Route::resource('tasks', 'TaskController'
//,[
   // 'except' =>['create','edit','show']
//]
);

//list single task
Route::get('task/{id}', 'TaskController@show');
//create  new task
Route::post('task','TaskController@store');

//update task
Route::put('Tasks','TaskController@store');

//delete task
Route::delete('tasks','TaskController@destroy');