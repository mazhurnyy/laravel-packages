<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 14.11.2017
 * Time: 0:03
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class LogResponse
 * Установка мета данных
 *
 * @package App\Facades
 */
class SiteMeta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SiteMeta';
    }
}