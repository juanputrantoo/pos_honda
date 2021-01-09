<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Auth::routes();

Route::get('/', 'AuthController@formLogin')->name('login');
Route::get('/login', 'AuthController@formLogin')->name('login');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'admin' || 'staff']], function () {

    Route::get('/home', 'PagesController@home')->name('home');

    // Items
    Route::get('/items/getPrice', 'ItemsController@getPrice')->name('items/getPrice');
    Route::get('/items/search', 'ItemsController@search')->name('items/search');
    Route::get('/items', 'ItemsController@index');
    Route::get('/items/{item}', 'ItemsController@show');

    // Orders
    Route::get('/orders/{id}/print', 'OrdersController@generateOrder')->name('orders/print');
    Route::resource('orders', 'OrdersController');
    Route::resource('itemorders', 'ItemOrdersController');

    // Users
    Route::patch('/users/{user}', 'UsersController@update')->name('users/update');
    Route::get('/users/{user}/changepassword', 'UsersController@changePassword')->name('users/changePassword');
    Route::patch('/users/{user}/updatepassword', 'UsersController@updatePassword')->name('users/updatePassword');

    // History
    Route::get('/history/orders/search', 'OrdersController@search')->name('orders/search');
    Route::get('/history/orders/dateRange', 'OrdersController@dateRange')->name('orders/dateRange');
    Route::get('/history/orders/all', 'OrdersController@historyAll')->name('history/orders/all');
    Route::get('/history/orders/detail/{order}', 'OrdersController@historyDetail')->name('history/orders/detail');
    Route::get('/history/orders/today', 'OrdersController@historyToday')->name('history/orders/today');
    Route::get('/history/items/deleted', 'ItemsController@deleted')->name('history/items/deleted');
    Route::post('/history/items/deleted/restore/{item}', 'ItemsController@restore')->name('history/items/deleted/restore');

});

Route::group(['middleware' => ['auth', 'admin']], function () {

    // Items
    Route::get('/items/create', 'ItemsController@create');
    Route::post('/items', 'ItemsController@store');
    Route::delete('/items/{item}', 'ItemsController@destroy');
    Route::get('/items/{item}/edit', 'ItemsController@edit')->name('items/edit');
    Route::patch('items/{item}', 'ItemsController@update');
    Route::patch('items/stock/{item}', 'ItemsController@addStock')->name('items/stock');

    // Users
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users/create');
    Route::post('/users', 'UsersController@store')->name('users/store');
    Route::get('/users/{user}/edit', 'UsersController@edit')->name('users/edit');
    Route::delete('/users/{user}', 'UsersController@destroy')->name('users/destroy');
    
    // Company
    Route::get('/company', 'CompaniesController@index')->name('company');
    Route::get('/company/{company}/edit', 'CompaniesController@edit')->name('company/edit');
    Route::patch('/company/{company}/update', 'CompaniesController@update')->name('company/update');

});

// Route::group(['middleware' => ['auth', 'staff']], function () {
// });

Route::get('/abort', function () {
    return view('abort');
});






// // -----------------------------------------------------------
// // Items
// Route::get('/items/getPrice', 'ItemsController@getPrice')->name('items/getPrice');
// Route::get('/items/search', 'ItemsController@search')->name('items/search');

// // Route::resource('items', 'ItemsController');
// Route::get('/items', 'ItemsController@index');
// Route::get('/items/create', 'ItemsController@create');
// Route::get('/items/{item}', 'ItemsController@show');
// Route::post('/items', 'ItemsController@store');
// Route::delete('/items/{item}', 'ItemsController@destroy');
// Route::get('/items/{item}/edit', 'ItemsController@edit')->name('items/edit');
// Route::patch('items/{item}', 'ItemsController@update');
// Route::patch('items/stock/{item}', 'ItemsController@addStock')->name('items/stock');


// // -----------------------------------------------------------
// // Orders

// Route::get('/orders/{id}/print', 'OrdersController@generateOrder')->name('orders/print');
// Route::resource('orders', 'OrdersController');

// // -----------------------------------------------------------
// // Item Orders
// Route::resource('itemorders', 'ItemOrdersController');


// // -----------------------------------------------------------
// // Users

// Route::get('/users', 'UsersController@index')->name('users');
// Route::get('/users/create', 'UsersController@create')->name('users/create');
// Route::post('/users', 'UsersController@store')->name('users/store');

// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users/edit');

// Route::patch('/users/{user}', 'UsersController@update')->name('users/update');
// Route::delete('/users/{user}', 'UsersController@destroy')->name('users/destroy');

// Route::get('/users/{user}/changepassword', 'UsersController@changePassword')->name('users/changePassword');
// Route::patch('/users/{user}/updatepassword', 'UsersController@updatePassword')->name('users/updatePassword');

// // -----------------------------------------------------------
// // History
// Route::get('/history/orders/search', 'OrdersController@search')->name('orders/search');
// Route::get('/history/orders/dateRange', 'OrdersController@dateRange')->name('orders/dateRange');
// Route::get('/history/orders/all', 'OrdersController@historyAll')->name('history/orders/all');
// Route::get('/history/orders/detail/{order}', 'OrdersController@historyDetail')->name('history/orders/detail');
// Route::get('/history/orders/today', 'OrdersController@historyToday')->name('history/orders/today');


// Route::get('/history/items/deleted', 'ItemsController@deleted')->name('history/items/deleted');
// Route::post('/history/items/deleted/restore/{item}', 'ItemsController@restore')->name('history/items/deleted/restore');


// // -----------------------------------------------------------
// // Company
// Route::get('/company', 'CompaniesController@index')->name('company');
// Route::get('/company/{company}/edit', 'CompaniesController@edit')->name('company/edit');
// Route::patch('/company/{company}/update', 'CompaniesController@update')->name('company/update');