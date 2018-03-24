<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 20.02.2018
 * Time: 15:08
 */

namespace Mazhurnyy\Provider;

use Illuminate\Support\ServiceProvider;
use App;

//use Blade;


class MazhurnyyServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        //Указываем, что файлы из папки config должны быть опубликованы при установке
        $this->publishes([__DIR__ . '/../../config/' => config_path() . '/']);

        $this->loadViewsFrom(__DIR__ . '/../../default/resources/views', 'mazhurnyy');

        $this->publishes([__DIR__ . '/../../default/resources/views' => resource_path('views/vendor/mazhurnyy'),]);

        $this->loadTranslationsFrom(__DIR__ . '/../../default/resources/lang', 'mazhurnyy');

        $this->publishes([__DIR__ . '/../../default/resources/lang' => resource_path('lang/vendor/mazhurnyy')]);

        $this->publishes([__DIR__ . '/../../default/resources/assets' => resource_path('assets/vendor/mazhurnyy')]);
    }


    public function register()
    {
        // Обработка файлов

        $this->app->bind('FileProcessing', function () {
            return new \Mazhurnyy\FileProcessing\FileProcessing();
        });

        $this->app->bind('Filters', function () {
            return new \Mazhurnyy\Filters\Filters();
        });

        $this->app->bind('SiteBlade', function () {
            return new \Mazhurnyy\Site\Blade\SiteBlade();
        });

        $this->app->bind('SiteMeta', function () {
            return new \Mazhurnyy\Site\Meta\SiteMeta();
        });


    }
}