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

//Route::get('/', 'LoginController@showLoginForm');



Auth::routes();

Route::resource('company', 'CompanyController')->middleware('isAdmin');
Route::get('user/{id}/createUserFromAdminToCompany', 'UserController@createUserFromAdminToCompany')->name('user.createUserFromAdminToCompany')->middleware('isAdmin');
Route::put('user/{id}/storeUserFromAdminToCompany', 'UserController@storeUserFromAdminToCompany')->name('user.storeUserFromAdminToCompany')->middleware('isAdmin');
Route::resource('user', 'UserController')->middleware('isEmployeeAdmin');

Route::get('employees', 'UserController@employees')->name('user.employees');
Route::get('vendors', 'UserController@vendors')->name('user.vendors');


Route::get('/home', 'HomeController@index')->name('home');
