<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/quotes/')->group(function () {
    Route::post('', 'QuoteController@create')->name('create');
    Route::get('', 'QuoteController@quotes')->name('quotes');
    Route::get('{id}', 'QuoteController@quote')->name('quote');
    Route::put('{id}', 'QuoteController@update')->name('update');
    Route::delete('{id}', 'QuoteController@destroy')->name('destroy');
});
