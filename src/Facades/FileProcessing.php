<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:24
 */

namespace Mazhurnyy\Facades;

use Illuminate\Support\Facades\Facade;

class FileProcessing extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'FileProcessing';
    }

}