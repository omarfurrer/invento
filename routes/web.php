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

Route::redirect('/', '/dashboard');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'DashboardController@getDashboard');

    Route::resource('measurement_units', 'MeasurementUnitsController');
    Route::resource('suppliers', 'SuppliersController');
    Route::resource('items', 'ItemsController');

    Route::get('log', 'LogController@index');
    Route::get('log/in/create', 'LogController@getCreateIn');
    Route::post('log/in/create', 'LogController@postCreateIn');
    Route::get('log/out/create', 'LogController@getCreateOut');
    Route::post('log/out/create', 'LogController@postCreateOut');

    Route::group(['prefix' => '/ajax', 'namespace' => 'API'], function () {
        Route::post('log/in/create', 'LogController@postCreateIn');
    });

    Route::group(['middleware' => ['role:admin|super admin'], 'prefix' => '/admin', 'namespace' => 'Admin'],
                 function () {
        Route::resource('users', 'UsersController');
        Route::get('items/approval/initial', 'ItemsController@getNeedsInitialApproval');
        Route::get('items/{item}/approval/initial', 'ItemsController@approveInitially');
        Route::delete('log/{log}', 'LogController@destroy');
    });
});

