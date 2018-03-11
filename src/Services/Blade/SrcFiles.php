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
 * возвращаем пути к файлам галереи
 */

class SrcFiles
{

    public function getSrcThumb($items)
    {
        return $this->getFirstFile($items)->src_thumb;
    }

    public function getSrcPreview($items)
    {
        return $this->getFirstFile($items)->src_preview;
    }

    public function getSrcFull($items)
    {
        return $this->getFirstFile($items)->src_full;
    }

    public function getSrcOriginal($items)
    {
        return $this->getFirstFile($items)->src_original;
    }

    private function getFirstFile($items)
    {
        return array_first($items->filesActual->sortBy('order'));
    }

}