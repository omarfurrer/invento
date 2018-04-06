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
    Route::get('/dashboard', 'PagesController@getDashboard');

    Route::group(['middleware' => ['role:admin|super admin'], 'prefix' => '/admin', 'namespace' => 'Admin'], function () {
        Route::resource('users', 'UsersController');
    });
});

