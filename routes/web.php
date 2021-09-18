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

/*
 * 
 */

Route::get('/', function () {
    echo "<a href='/login'>Click to Go to Login Page</a>";
});


// Admin Routes
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('/',                      'HomeController@index')->name('.index');
    Route::get('/users',                 'UsersController@index')->name('.users.index');
    Route::get('/users/create',          'UsersController@create')->name('.users.create');
    Route::post('/users/store',          'UsersController@store')->name('.users.store');
    Route::get('/users/edit/{id}',       'UsersController@edit')->name('.users.edit');
    Route::put('/users/update/{id}',     'UsersController@update')->name('.users.update');
    Route::delete('/users/delete/{id}',  'UsersController@delete')->name('.users.delete');

    Route::get('/products',                 'ProductsController@index')->name('.products.index');
    Route::get('/products/create',          'ProductsController@create')->name('.products.create');
    Route::post('/products/store',          'ProductsController@store')->name('.products.store');
    Route::get('/products/edit/{id}',       'ProductsController@edit')->name('.products.edit');
    Route::put('/products/update/{id}',     'ProductsController@update')->name('.products.update');
    Route::delete('/products/delete/{id}',  'ProductsController@delete')->name('.products.delete');

    Route::get('/category',                 'CategoryController@index')->name('.category.index');
    Route::get('/category/create',          'CategoryController@create')->name('.category.create');
    Route::post('/category/store',          'CategoryController@store')->name('.category.store');
    Route::get('/category/edit/{id}',       'CategoryController@edit')->name('.category.edit');
    Route::put('/category/update/{id}',     'CategoryController@update')->name('.category.update');
    Route::delete('/category/delete/{id}',  'CategoryController@delete')->name('.category.delete');

    Route::get('/video-link',                 'VideoLinkController@index')->name('.video-link.index');
});


// Auth Routes
Route::group(['namespace' => 'Auth', 'as' => 'auth'], function(){
    // Login Page 
    Route::get('/login',     'LoginController@showLoginForm')->name('.login');
    // Login Post
    Route::post('/login',    'LoginController@login')->name('.login');
    // Logout
    Route::get('/logout',    'LoginController@logout')->name('.logout');
});