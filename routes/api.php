<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('categories', 'CategoryController@index');
Route::get('categories/{category}/products', 'CategoryController@show');

Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::post('categories', 'CategoryController@store');
        Route::put('categories/{category}', 'CategoryController@update');
        Route::delete('categories/{category}', 'CategoryController@destroy');

        Route::post('products', 'ProductController@store');
        Route::put('products/{product}', 'ProductController@update');
        Route::delete('products/{product}', 'ProductController@destroy');
    }
);
