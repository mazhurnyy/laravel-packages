<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 13.07.2017
 * Time: 20:33
 */

namespace Mazhurnyy\Services;

use Mazhurnyy\Services\Storage\Selectel;

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
        $this->storage_driver();
    }


    private function selectel(){
        $this->container = new Selectel();
        $this->container =  $this->container->getGallery();
    }


}