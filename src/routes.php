<?php

/** Подключаем локализацию для роутов    */
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    /** Статья */

    Route::group(['prefix' => 'article'], function () {
        Route::get('{alias}', 'App\Http\Controllers\ArticleController@index')->name('article');
        Route::post('{alias}', 'App\Http\Controllers\ArticleController@showMore');
    });

});


Route::group(['prefix' => 'file', 'middleware' => 'web'], function () {
    Route::post('add', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileAdd')->name('file.add');
    Route::post('delete', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileDelete')->name('file.delete');
    Route::post('restore', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileRestore')->name('file.restore');
    Route::post('order', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileOrder')->name('file.order');
    Route::post('filter', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileFilter')->name('file.filter');
});
