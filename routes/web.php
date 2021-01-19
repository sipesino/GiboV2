<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
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

Route::get('/', 'TasksController@index');

// Route::resource('task', 'TasksController');

Route::post('/', 'TasksController@store');

Route::get('/', 'TasksController@show');

// Sample

Route::get('/sample', 'TasksController@sample');

Route::get('/sample/load/{id}', 'TasksController@loadTodo');

Route::post('/sample/add', 'TasksController@addTodo');

Route::put('/sample/update', 'TasksController@updateTodo');
