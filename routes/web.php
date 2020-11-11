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

// Route::group(['middleware' => ['auth', 'admin' || 'staff']], function () {
    
// });

// Route::group(['middleware' => ['auth', 'admin']], function () {
// });

// Route::group(['middleware' => ['auth', 'staff']], function () {
// });

Route::get('/abort', function () {
    return view('abort');
});



Route::get('/home', 'PagesController@home')->name('home');


// -----------------------------------------------------------
// Items
Route::get('/items/getPrice', 'ItemsController@getPrice')->name('items/getPrice');
Route::get('/items/search', 'ItemsController@search')->name('items/search');

// Route::resource('items', 'ItemsController');
Route::get('/items', 'ItemsController@index');
Route::get('/items/create', 'ItemsController@create');
Route::get('/items/{item}', 'ItemsController@show');
Route::post('/items', 'ItemsController@store');
Route::delete('/items/{item}', 'ItemsController@destroy');
Route::get('/items/{item}/edit', 'ItemsController@edit')->name('items/edit');
Route::patch('items/{item}', 'ItemsController@update');
Route::patch('items/stock/{item}', 'ItemsController@addStock')->name('items/stock');


// -----------------------------------------------------------
// Orders

Route::get('/orders/{id}/print', 'OrdersController@generateOrder')->name('orders/print');
Route::resource('orders', 'OrdersController');

// -----------------------------------------------------------
// Item Orders
Route::resource('itemorders', 'ItemOrdersController');


// -----------------------------------------------------------
// Users

Route::get('/users', 'UsersController@index')->name('users');
Route::get('/users/create', 'UsersController@create')->name('users/create');
Route::post('/users', 'UsersController@store')->name('users/store');

Route::get('/users/{user}/edit', 'UsersCOntroller@edit')->name('users/edit');
Route::get('/users/{user}/editprofile', 'UsersCOntroller@editProfile')->name('users/editProfile');
// Route::get('/users/{user}/changepassword', 'UsersCOntroller@editPas')->name('users/editProfile');

Route::patch('/users/{user}', 'UsersController@update')->name('users/update');
Route::patch('/users/updateProfile/{user}', 'UsersController@updateProfile')->name('users/updateProfile');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users/destroy');

// -----------------------------------------------------------
// History

Route::get('/history/orders/search', 'OrdersController@search')->name('orders/search');
Route::get('/history/orders/dateRange', 'OrdersController@dateRange')->name('orders/dateRange');
Route::get('/history/orders/all', 'OrdersController@historyAll')->name('history/orders/all');
Route::get('/history/orders/all/detail/{order}', 'OrdersController@historyDetail')->name('history/orders/all/detail');
Route::get('/history/orders/today', 'OrdersController@historyToday')->name('history/orders/today');



