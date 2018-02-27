<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:24
 */

namespace Mazhurnyy\SaveFile;

use Illuminate\Support\Facades\Facade;

class SaveFile extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'SaveFile';
    }

}