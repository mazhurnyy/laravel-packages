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

    public function original($items)
    {
        return count($items->filesActual) > 0 ? $this->getFirstFile($items)->src_original : null;
    }

    public function xs($items)
    {
        return count($items->filesActual) > 0 ?  $this->getFirstFile($items)->src_xs : null ;
    }

    public function sm($items)
    {
        return count($items->filesActual) > 0 ?  $this->getFirstFile($items)->src_sm : null;
    }

    public function md($items)
    {
        return count($items->filesActual) > 0 ? $this->getFirstFile($items)->src_md : null;
    }

    public function lg($items)
    {
        return count($items->filesActual) > 0 ? $this->getFirstFile($items)->src_lg : null;
    }

// old
    public function thumb($items)
    {
        return count($items->filesActual) > 0 ?  $this->getFirstFile($items)->src_thumb : null ;
    }

    public function preview($items)
    {
        return count($items->filesActual) > 0 ?  $this->getFirstFile($items)->src_preview : null;
    }

    public function full($items)
    {
        return count($items->filesActual) > 0 ? $this->getFirstFile($items)->src_full : null;
    }
// end old


    private function getFirstFile($items)
    {
        return count($items->filesActual) > 0 ? array_first($items->filesActual->sortBy('order')) : null;
    }

}