<?php

namespace Mazhurnyy\FileProcessing\Traits;

/**
 * Работа с облачным хранилищем Selectel
 *
 * Trait StorageSelectel
 */


use ArgentCrusade\Selectel\CloudStorage\Api\ApiClient;
use ArgentCrusade\Selectel\CloudStorage\CloudStorage;

trait StorageSelectel {

    /**
     * записываем файл на диск селектел
     *
     * @param $url
     * @param $file
     * @param $params
     */
    protected function setSelectel($url, $file, $params)
    {
        $this->getContainerSelectel();
        $this->container->uploadFromStream($url, $file, $params);
        $file           = $this->container->files()->find($url);
        $this->size = $file->size();
    }

    protected function setSelectelTemp($url, $file, $params)
    {
        $this->getContainerSelectel();
        $this->container_temp->uploadFromStream($url, $file, $params);
        $file           = $this->container->files()->find($url);
        $this->size = $file->size();
    }

    private function getContainerSelectel()
    {

        /* todo
        |  в файл vendor\argentcrusade\selectel-cloud-storage\src\FileUploader.php добавлены недостающие параметры заголовка
        | 'contentLength'      => 'Content-Length',
        | 'metaLocation'       => 'X-Object-Meta-Location',
        */

        $apiClient       = new ApiClient(
            config('mazhurnyy.disks.selectel.username'), config('mazhurnyy.disks.selectel.password')
        );
        $storage         = new CloudStorage($apiClient);
        $this->container = $storage->getContainer(config('mazhurnyy.disks.selectel.container'));
        $this->container_temp = $storage->getContainer(config('mazhurnyy.disks.selectel_temp.container'));
    }


}