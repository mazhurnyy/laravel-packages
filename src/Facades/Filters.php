<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 14.11.2017
 * Time: 23:07
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class LogResponse
 * Установка переметров страницы для шаблонов
 *
 * @package App\Facades
 */
class Filters extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Filters';
    }
}