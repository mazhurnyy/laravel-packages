<?php

Route::group(['prefix' => 'file', 'middleware' => 'web'], function () {
    Route::post('add', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileAdd')->name('file.add');
    Route::post('delete', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileDelete')->name('file.delete');
    Route::post('order', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileOrder')->name('file.order');
});