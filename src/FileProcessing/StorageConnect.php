<?php

namespace Mazhurnyy\FileProcessing;

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
     * @var int
     */
    private $size_img = 0;
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
        $this->$storage_driver($file, $url, $params);
        return $this->size_img;
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
        $file           = $this->container->files()->find($url);
        $this->size_img = $file->size();
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
    }

}