<?php

/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 27.02.2018
 * Time: 15:16
 */

namespace Mazhurnyy\Services\Storage\Selectel;

use ArgentCrusade\Selectel\CloudStorage\Api\ApiClient;
use ArgentCrusade\Selectel\CloudStorage\CloudStorage;

class Selectel
{

/* todo
|  в файл vendor\argentcrusade\selectel-cloud-storage\src\FileUploader.php добавлены недостающие параметры заголовка
| 'contentLength'      => 'Content-Length',
| 'metaLocation'       => 'X-Object-Meta-Location',
*/

    /**
     * подключение к хранилищу selectel
     */
    protected static function getContainer()
    {
        $apiClient = new ApiClient(config('mazhurnyy.selectel.username'), config('mazhurnyy.selectel.password'));
        $storage = new CloudStorage($apiClient);
        return $storage->getContainer(config('mazhurnyy.selectel.container'));
    }

}