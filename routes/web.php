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
