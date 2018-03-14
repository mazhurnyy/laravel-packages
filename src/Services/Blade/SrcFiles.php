<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 10.03.2018
 * Time: 22:36
 */

namespace Mazhurnyy\Services\Blade;

/**
 * Class SrcFiles
 * возвращаем путm к первому файлу в галерее
 */

class SrcFiles
{

    public function thumb($items)
    {
        return $this->getFirstFile($items)->src_thumb;
    }

    public function preview($items)
    {
        return $this->getFirstFile($items)->src_preview;
    }

    public function full($items)
    {
        return $this->getFirstFile($items)->src_full;
    }

    public function original($items)
    {
        return $this->getFirstFile($items)->src_original;
    }

    private function getFirstFile($items)
    {
        return array_first($items->filesActual->sortBy('order'));
    }

}