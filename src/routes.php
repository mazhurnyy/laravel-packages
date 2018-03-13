<?php

Route::group(['prefix' => 'file', 'middleware' => 'web'], function () {
    Route::post('add', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileAdd')->name('file.add');
    Route::post('delete', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileDelete')->name('file.delete');
    Route::post('order', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileOrder')->name('file.order');
});


/** Подключаем локализацию для роутов    */
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    /** Статья */

    Route::group(['prefix' => 'article'], function () {
        Route::get('{alias}', 'ArticleController@index')->name('article');
        Route::post('{alias}', 'ArticleController@showMore');
    });

    /** Регистрация, переопределяем стандартные роуты  */
    Route::group(['prefix' => 'register'], function () {
        // начало регистрации
        Route::get('', 'Auth\RegisterController@showLinkForm')->name('register');
        // продолжение регистрации
        Route::get('/{token}', 'Auth\RegisterController@showRegistrationForm')->name('register.completion');
        // отпавляем ссылку
        Route::post('', 'Auth\RegisterController@sendLink')->name('register.email');
        // окончание регистрации, заносим в базу и редирект на профиль
        Route::post('/concluding', 'Auth\RegisterController@concluding')->name('register.concluding');
    });

    /** Password Reset Routes...     */
    Route::group(['prefix' => 'reset'], function () {
        // начало сброса
        Route::get('', 'Auth\ResetPasswordController@showLinkForm')->name('reset');
        // продолжение сброса пароля
        Route::get('/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset.completion');
        // отправляем ссылку
        Route::post('/email', 'Auth\ResetPasswordController@sendLink')->name('reset.email');
        // окончание сброса, обновляем пароль в таблице
        Route::post('', 'Auth\ResetPasswordController@concluding')->name('reset.concluding');
    });

    /** Вход  */
    Route::group(['prefix' => 'login'], function () {
        Route::get('', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('', 'Auth\LoginController@login')->name('login.check');
    });

});