<?php

Route::prefix('/api/quotes/')->group(function () {
    Route::post('', 'QuoteController@create')->name('create');
    Route::get('', 'QuoteController@quotes')->name('quotes');
    Route::get('{id}', 'QuoteController@quote')->name('quote');
    Route::put('{id}', 'QuoteController@update')->name('update');
    Route::delete('{id}', 'QuoteController@destroy')->name('destroy');
});
