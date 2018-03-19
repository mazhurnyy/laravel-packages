<?php


/** Подключаем локализацию для роутов    */
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
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
        Route::get('', 'Mazhurnyy\RegisterController@showLinkForm')->name('register');
        // продолжение регистрации
        Route::get('/{token}', 'Mazhurnyy\RegisterController@showRegistrationForm')->name('register.completion');
        // отпавляем ссылку
        Route::post('', 'Mazhurnyy\RegisterController@sendLink')->name('register.email');
        // окончание регистрации, заносим в базу и редирект на профиль
        Route::post('/concluding', 'Mazhurnyy\RegisterController@concluding')->name('register.concluding');
    });

    /** Password Reset Routes...     */
    Route::group(['prefix' => 'reset'], function () {
        // начало сброса
        Route::get('', 'Mazhurnyy\ResetPasswordController@showLinkForm')->name('reset');
        // продолжение сброса пароля
        Route::get('/{token}', 'Mazhurnyy\ResetPasswordController@showResetForm')->name('reset.completion');
        // отправляем ссылку
        Route::post('/email', 'Mazhurnyy\ResetPasswordController@sendLink')->name('reset.email');
        // окончание сброса, обновляем пароль в таблице
        Route::post('', 'Mazhurnyy\ResetPasswordController@concluding')->name('reset.concluding');
    });

    /** Вход  */
    Route::group(['prefix' => 'login'], function () {
        Route::get('', 'Mazhurnyy\LoginController@showLoginForm')->name('login');
        Route::post('', 'Mazhurnyy\LoginController@login')->name('login.check');
    });

});

/**
 * Выход
 */
Route::get('/exit', 'Auth\ExitUser@index')->name('exit');

Route::group(['prefix' => 'file', 'middleware' => 'web'], function () {
    Route::post('add', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileAdd')->name('file.add');
    Route::post('delete', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileDelete')->name('file.delete');
    Route::post('restore', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileRestore')->name('file.restore');
    Route::post('order', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileOrder')->name('file.order');
    Route::post('filter', 'Mazhurnyy\Http\Controllers\FileProcessingController@fileFilter')->name('file.filter');
});
