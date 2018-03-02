<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 14.11.2017
 * Time: 15:32
 */

namespace Mazhurnyy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class LogResponse
 * Установка переметров страницы для шаблонов
 *
 * @package App\Facades
 */
class SiteBlade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SiteBlade';
    }
}