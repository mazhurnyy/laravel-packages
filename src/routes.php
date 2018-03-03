<?php

Route::group(['prefix' => 'file', 'middleware' => 'web'], function () {
    Route::post('add', 'Mazhurnyy\Http\Controllers\FileProcessing@fileAdd')->name('file.add');
    Route::post('delete', 'Mazhurnyy\Http\Controllers\FileProcessing@fileDelete')->name('file.delete');
    Route::post('order', 'Mazhurnyy\Http\Controllers\FileProcessing@fileOrder')->name('file.order');
});