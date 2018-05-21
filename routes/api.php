<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

// Route::group([
//     'middleware' => 'auth:pomoking-api'
// ], function () {
//     // Route::get('/test', function(){
//     //   return ['name' => 'Taylor'];
//     // });
//
// });
// //
// Route::get('/test', function(){
//   return ['name' => 'Taylor'];
// });

Route::prefix('v1')->group(function(){
    Route::group(['prefix' => '/tasks'], function(){
        Route::get('/', 'TaskController@index');
        Route::post('/', 'TaskController@store');
        Route::put('/', 'TaskController@update');
        Route::get('/completed_at/{id}', 'TaskController@changeCompleteStatus');
        Route::get('/{id}', 'TaskController@show');
        Route::delete('/{id}', 'TaskController@destroy');
//        Se não adiociona o recurso caso o mesmo não exista não deveria ser patch??
    });
    Route::group(['prefix' => '/categories'], function(){
        Route::get('/', 'CategoryController@index');
        Route::post('/', 'CategoryController@store');
        Route::put('/', 'CategoryController@update');
        Route::get('/{id}', 'CategoryController@show');
        Route::delete('/{id}', 'CategoryController@destroy');
    });
});

