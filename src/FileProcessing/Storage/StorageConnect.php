<?php

namespace Mazhurnyy\FileProcessing\Storage;

use ArgentCrusade\Selectel\CloudStorage\Api\ApiClient;
use ArgentCrusade\Selectel\CloudStorage\CloudStorage;

/**
 * Подключение к хранилищу данных
 *
 * @package App\Cron
 */
class StorageConnect
{

    /**
     * @var object контейнер хранения файлов
     */
    protected $container;
    /**
     * @var string выбираем драйвер для записи файла
     */
//    protected $storage_driver;

    /**
     * StorageConnect constructor.
     */
    public function __construct()
    {
//        $this->storage_driver = 'set' . config('mazhurnyy.storage_driver');
    }

    /**
     * @param $url    путь к файлу
     * @param $file   object
     * @param $params параметры сохранения
     */
    public function saveFile($url, $file, $params = [])
    {
        $storage_driver = 'set' . config('mazhurnyy.storage_driver');
        $this->size     = $this->$storage_driver($file, $url, $params);
    }

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
        $file       = $this->container->files()->find($url);
        $this->size = $file->size();
    }


    private function getContainerSelectel()
    {
        $apiClient       = new ApiClient(
            config('mazhurnyy.disks.selectel.username'), config('mazhurnyy.disks.selectel.password')
        );
        $storage         = new CloudStorage($apiClient);
        $this->container = $storage->getContainer(config('mazhurnyy.disks.selectel.container'));
    }

}