<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 11.11.2017
 * Time: 14:30
 */

namespace Mazhurnyy\Services\Logs;

use Mazhurnyy\Models\PersonTypeActivity;


/**
 * Определяем новый и страрый Url для роутов, при изменении алиаса модели
 *
 * @package Mazhurnyy\Services
 */
trait RedirectModelUrl
{

    /**
     * Статьи - редиректы 301 при смене названия
     * @return array
     */
    public function getUrlArticle()
    {
        return [
            [
                'old' => route('article', ['alias' => $this->model->getOriginal('alias')], false),
                'new' => route('article', ['alias' => $this->alias], false),
            ]
        ];
    }

    /**
     * Бренды - редиректы 301 при смене названия
     * @return array
     */
    public function getUrlBrand()
    {
        return [
            [
                'old' => route('brand_alias', ['alias' => $this->model->getOriginal('alias')], false),
                'new' => route('brand_alias', ['alias' => $this->alias], false),
            ]
        ];
    }

    /**
     * Модели устройств - редиректы 301 при смене названия
     * @return array
     */
    public function getUrlDevice()
    {
        return [
            [
                'old' => route('device_alias', ['alias' => $this->model->getOriginal('alias')], false),
                'new' => route('device_alias', ['alias' => $this->alias], false),
            ]
        ];
    }

    /**
     * Модели устройств - редиректы 301 при смене названия
     * @return array
     */
    public function getUrlModelDevice()
    {
        return [
            [
                'old' => '',
                'new' => '',
            ]
        ];
    }
}