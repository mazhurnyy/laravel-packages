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

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        //Указываем, что файлы из папки config должны быть опубликованы при установке
        $this->publishes([__DIR__ . '/../config/' => config_path() . '/']);

        //Так же публикуем тестовый виджет с каталогом для пользовательских виджетов
//        $this->publishes([__DIR__ . '/../app/' => app_path() . '/']);


        /*
         * Регистрируется директива для шаблонизатора Blade
         * Пример обращения к виджету: @widget('menu')
         * Можно передать параметры в виджет:
         * @widget('menu', [$data1,$data2...])
        */
  /*
        Blade::directive('widget', function ($name) {
            return "<?php echo app('widget')->show($name); ?>";
        });
*/
        /*
         * Регистрируется (добавляем) каталог для хранения шаблонов виджетов
         * app\Widgets\view
         */
  //      $this->loadViewsFrom(app_path() .'/Widgets/views', 'Widgets');

    }


    public function register()
    {
        // Обработка файлов

        $this->app->bind('SaveFile', function () {
            return new Mazhurnyy\SaveFile\SaveFile();
        });
/*
        $this->app->singleton(LaravelFileProcessing::class, function () {
            return new LaravelFileProcessing();
        });
*/
  //      $this->app->alias(LaravelLocalization::class, 'laravellocalization');

    }
}