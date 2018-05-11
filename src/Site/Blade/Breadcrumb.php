<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.05.2018
 * Time: 20:59
 */

namespace Mazhurnyy\Site\Blade;

use App\Models\Map;
use Mazhurnyy\Services\Blade\MapTrait;

trait Breadcrumb
{
    use MapTrait;

    protected $model;

    /**
     * @param $model object модель, для которой строим хлебные крошки
     * @param array $breadcrumb
     *
     * @return array
     */
    protected function getBreadcrumbModel($model, $breadcrumb = [])
    {
        $this->model = $model;
        $map = Map::whereObjectTypeId($this->getObjectTypeId())->whereObjectId($this->model->id)->first();
        $ancestors = $map->getAncestors();
        foreach ($ancestors as $item) {

            if (!empty($item->visibility)) {
                $route = $item->alias ? route($item->route, ['alias' => $item->alias]) : route($item->route);
                $breadcrumb[] = [
                    'link' => $route,
                    'title' => $item->title,
                ];
            }
        }
        return $breadcrumb;
    }


}