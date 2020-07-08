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

// Sales Order
Route::group(['prefix' => 'sales_order'], function (){
    Route::get          ('/',                            'SalesOrderController@index'                    )->name('reason');
    Route::post         ('/save',                        'SalesOrderController@store'                    )->name('reason_store');
    Route::get          ('/edit/{id}',                   'SalesOrderController@edit'                     )->name('reason_edit');
    Route::get          ('/{type}/{id}/{value}',         'SalesOrderController@layout'                   )->name('reason_edit');
    Route::post         ('/update/{id}',                 'SalesOrderController@update'                   )->name('reason_update');
    Route::get          ('/destroy/{id}',                'SalesOrderController@destroy'                  )->name('reason_update');
    Route::get          ('/payment/{id}',                'SalesOrderController@payment'                  )->name('reason_update');
});

// Expense
Route::group(['prefix' => 'expense'], function (){
    Route::get          ('/',                            'ExpenseController@index'                    )->name('reason');
    Route::post         ('/save',                        'ExpenseController@store'                    )->name('reason_store');
    Route::get          ('/edit/{id}',                   'ExpenseController@edit'                     )->name('reason_edit');
    Route::post         ('/update/{id}',                 'ExpenseController@update'                   )->name('reason_update');
    Route::get          ('/destroy/{id}',                'ExpenseController@destroy'                  )->name('reason_update');
});

// Dashboard
Route::group(['prefix' => 'dashboard'], function (){
    Route::get          ('/',                            'DashboardController@index'                    )->name('reason');
    Route::post         ('/save',                        'DashboardController@store'                    )->name('reason_store');
    Route::get          ('/edit/{id}',                   'DashboardController@edit'                     )->name('reason_edit');
    Route::post         ('/update/{id}',                 'DashboardController@update'                   )->name('reason_update');
    Route::get          ('/destroy/{id}',                'DashboardController@destroy'                  )->name('reason_update');
});

// Overall
Route::group(['prefix' => 'overall'], function (){
    Route::get          ('/',                            'ExpenseController@overall'                    )->name('reason');
});

// Expense Type
Route::group(['prefix' => 'expense_type'], function (){
    Route::get          ('/',                            'ExpenseTypeController@index'                    )->name('reason');
    Route::post         ('/save',                        'ExpenseTypeController@store'                    )->name('reason_store');
    Route::get          ('/edit/{id}',                   'ExpenseTypeController@edit'                     )->name('reason_edit');
    Route::post         ('/update/{id}',                 'ExpenseTypeController@update'                   )->name('reason_update');
    Route::get          ('/destroy/{id}',                'ExpenseTypeController@destroy'                  )->name('reason_update');
});

// Clients
Route::group(['prefix' => 'client'], function (){
    Route::get          ('/',                            'ClientController@index'                    )->name('reason');
    Route::post         ('/save',                        'ClientController@store'                    )->name('reason_store');
    Route::get          ('/edit/{id}',                   'ClientController@edit'                     )->name('reason_edit');
    Route::post         ('/update/{id}',                 'ClientController@update'                   )->name('reason_update');
    Route::get          ('/destroy/{id}',                'ClientController@destroy'                  )->name('reason_update');
});

// Payment
Route::group(['prefix' => 'payment'], function (){
    Route::get          ('/',                            'PaymentController@index'                    )->name('reason');
    Route::post         ('/save',                        'PaymentController@store'                    )->name('reason_store');
    Route::get          ('/edit/{id}',                   'PaymentController@edit'                     )->name('reason_edit');
    Route::post         ('/update/{id}',                 'PaymentController@update'                   )->name('reason_update');
    Route::get          ('/destroy/{id}',                'PaymentController@destroy'                  )->name('reason_update');
});

// Category
Route::group(['prefix' => 'category'], function (){
    Route::get          ('/',                            'CategoryController@index'                    )->name('reason');
    Route::post         ('/save',                        'CategoryController@store'                    )->name('reason_store');
    Route::get          ('/edit/{id}',                   'CategoryController@edit'                     )->name('reason_edit');
    Route::post         ('/update/{id}',                 'CategoryController@update'                   )->name('reason_update');
    Route::get          ('/destroy/{id}',                'CategoryController@destroy'                  )->name('reason_update');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
