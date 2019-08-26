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


Route::get('/', 'HomeController@index');
Auth::routes();

Route::resource('company', 'CompanyController')->middleware('isAdmin');
Route::get('user/{id}/createUserFromAdminToCompany', 'UserController@createUserFromAdminToCompany')->name('user.createUserFromAdminToCompany')->middleware('isAdmin');
Route::put('user/{id}/storeUserFromAdminToCompany', 'UserController@storeUserFromAdminToCompany')->name('user.storeUserFromAdminToCompany')->middleware('isAdmin');
Route::get('user/createVendorFromCompanyAdmin', 'UserController@createVendorFromCompanyAdmin')->name('user.createVendorFromCompanyAdmin')->middleware('isEmployeeAdmin');
Route::post('user/storeVendorFromCompanyAdmin', 'UserController@storeVendorFromCompanyAdmin')->name('user.storeVendorFromCompanyAdmin')->middleware('isEmployeeAdmin');
Route::get('user/{id}/editVendorFromCompanyAdmin', 'UserController@editVendorFromCompanyAdmin')->name('user.editVendorFromCompanyAdmin')->middleware('isEmployeeAdmin');
Route::put('user/{id}/updateVendorFromCompanyAdmin', 'UserController@updateVendorFromCompanyAdmin')->name('user.updateVendorFromCompanyAdmin')->middleware('isEmployeeAdmin');
Route::resource('user', 'UserController')->middleware('isEmployeeAdmin');
Route::get('user/{id}/editPasswordFromCompanyAdmin', 'UserController@editPasswordFromCompanyAdmin')->name('user.editPasswordFromCompanyAdmin')->middleware('isEmployeeAdmin');
Route::put('user/{id}/updatePasswordFromCompanyAdmin', 'UserController@updatePasswordFromCompanyAdmin')->name('user.updatePasswordFromCompanyAdmin')->middleware('isEmployeeAdmin');


Route::get('employees', 'UserController@employees')->name('user.employees');
Route::get('vendors', 'UserController@vendors')->name('user.vendors');

Route::resource('wallet', 'WalletController')->middleware('isEmployeeAdmin');
Route::resource('product', 'ProductController')->middleware('isEmployeeAdmin');
Route::get('/home', 'HomeController@index')->name('home');
