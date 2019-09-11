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



Route::get('/', 'HomeController@index');
Auth::routes();
Route::get('sendEmail','PluginsController@sendEmail');

Route::group(['middleware' => ['auth']], function() {

    Route::group(['middleware' => ['isAdmin']], function() {
        Route::resource('company', 'CompanyController');
        Route::get('user/{id}/createUserFromAdminToCompany', 'UserController@createUserFromAdminToCompany')->name('user.createUserFromAdminToCompany');
        Route::put('user/{id}/storeUserFromAdminToCompany', 'UserController@storeUserFromAdminToCompany')->name('user.storeUserFromAdminToCompany');
    });

    Route::group(['middleware' => ['isEmployeeAdmin']], function() {
        Route::get('user/createVendorFromCompanyAdmin', 'UserController@createVendorFromCompanyAdmin')->name('user.createVendorFromCompanyAdmin');
        Route::post('user/storeVendorFromCompanyAdmin', 'UserController@storeVendorFromCompanyAdmin')->name('user.storeVendorFromCompanyAdmin');
        Route::get('user/{id}/editVendorFromCompanyAdmin', 'UserController@editVendorFromCompanyAdmin')->name('user.editVendorFromCompanyAdmin');
        Route::put('user/{id}/updateVendorFromCompanyAdmin', 'UserController@updateVendorFromCompanyAdmin')->name('user.updateVendorFromCompanyAdmin');
        Route::resource('user', 'UserController');

        Route::get('user/{id}/editPasswordFromCompanyAdmin', 'UserController@editPasswordFromCompanyAdmin')->name('user.editPasswordFromCompanyAdmin');

        Route::put('user/{id}/updatePasswordFromCompanyAdmin', 'UserController@updatePasswordFromCompanyAdmin')->name('user.updatePasswordFromCompanyAdmin');

        Route::get('employees', 'UserController@employees')->name('user.employees');
        Route::get('getEmployees', 'UserController@getEmployees')->name('user.getEmployees');
        Route::get('vendors', 'UserController@vendors')->name('user.vendors');
        Route::resource('wallet', 'WalletController');
    });

    Route::group(['middleware' => ['isAdminAndEmployee']], function() {
        Route::resource('product', 'ProductController');
        Route::resource('expense', 'ExpenseController');
        Route::resource('purchase', 'PurchaseController');
        Route::resource('sale', 'SaleController');
        Route::resource('debt', 'DebtController');
        Route::resource('payment', 'PaymentController');
        Route::get('payment/{id}/createPayment', 'PaymentController@createPayment')->name('payment.createPayment');
        Route::post('payment/{id}/storePayment', 'PaymentController@storePayment')->name('payment.storePayment');
        Route::get('employeePage', 'UserController@employeePage')->name('user.employeePage');
        Route::get('getExpensesForEmployee','ExpenseController@getExpensesForEmployee')->name('expense.getExpensesForEmployee');
        Route::get('getPurchasesForEmployee','PurchaseController@getPurchasesForEmployee')->name('purchase.getPurchasesForEmployee');
        Route::get('getSalesForEmployee','SaleController@getSalesForEmployee')->name('sale.getSalesForEmployee');
        Route::get('getDebtsForEmployee','DebtController@getDebtsForEmployee')->name('debt.getDebtsForEmployee');
        Route::get('getProductsForEmployee','ProductController@getProductsForEmployee')->name('product.getProductsForEmployee');

    });

    Route::get('/home', 'HomeController@index')->name('home');
});
