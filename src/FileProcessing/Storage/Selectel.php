<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 27.02.2018
 * Time: 15:16
 */

namespace Mazhurnyy\FileProcessing\Storage;

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
    public function container()
    {
        $apiClient = new ApiClient(config('mazhurnyy.disks.selectel.username'), config('mazhurnyy.disks.selectel.password'));
        $storage = new CloudStorage($apiClient);
        $this->container = $storage->getContainer(config('mazhurnyy.disks.selectel.container'));
    }

}