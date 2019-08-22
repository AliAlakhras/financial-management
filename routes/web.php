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
    return view('layout.template');
});

Auth::routes();

Route::get('employees', 'UserController@employees')->name('user.employees');
Route::get('vendors', 'UserController@vendors')->name('user.vendors');

Route::resource('user', 'UserController');
Route::resource('company', 'CompanyController');

Route::get('/home', 'HomeController@index')->name('home');
