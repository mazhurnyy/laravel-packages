<?php

namespace Mazhurnyy\FileProcessing;


use Mazhurnyy\FileProcessing\Traits\StorageSelectel;

/**
 * Подключение к хранилищу данных
 *
 * @package App\Cron
 */
class StorageConnect
{
    use StorageSelectel;
    /**
     * @var object контейнер хранения файлов
     */
    protected $container;
    /**
     * @var int
     */
    private $size = 0;

    /**
     * StorageConnect constructor.
     */
    public function __construct()
    {
        //
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
        return $this->size;
    }

    /**
     * @param $url    путь к файлу
     * @param $file   object
     * @param $params параметры сохранения
     */
    public function saveFileTemp($url, $file, $params = [])
    {
        $storage_driver = 'set' . config('mazhurnyy.storage_driver_temp');
        $this->$storage_driver_temp($file, $url, $params);
        return $this->size;
    }



}