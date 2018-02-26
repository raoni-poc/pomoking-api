<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@show');
Route::get('/home', 'HomeController@show');
//
////pomodoros routes
//Route::get('/pomodoros/datatable','PomodoroController@indexDataTable')->name('pomodoros.dataTable');
//Route::resource('/pomodoros', 'PomodoroController');
//
////tasks routes
//Route::get('/tasks/datatable','TaskController@indexDataTable')->name('tasks.dataTable');
//Route::resource('/tasks', 'TaskController');
//
////categories routes
//Route::get('/categories/datatable','CategoryController@indexDataTable')->name('categories.dataTable');
//Route::resource('/categories', 'CategoryController');
