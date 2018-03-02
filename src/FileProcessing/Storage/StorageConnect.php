<?php

namespace Mazhurnyy\FileProcessing\Storage;

use Mazhurnyy\FileProcessing\Storage\Selectel;

/**
 * Подключение к хранилищу данных
 *
 * @package App\Cron
 */
class StorageConnect
{

    /**
     * @var object контейнер хранения файлов     */
    protected $container;

    /**
     * StorageConnect constructor.
     */
    public function __construct()
    {
        $storage_driver = config('mazhurnyy.storage_driver');
        $this->$storage_driver();
    }


    private function selectel(){
        $this->container = new Selectel();
        $this->container =  $this->container->getGallery();
    }


}