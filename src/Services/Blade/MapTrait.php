<?php

namespace Mazhurnyy\Services\Blade;

use App\Models\BindingType;
use App\Models\Sheet;
use App\Models\ObjectType;

trait MapTrait
{

    /**
     * @var int ID страницы
     */
    protected $page;
    /**
     * @var int ID объекта
     */
    protected $object_id;

    protected function getSheetId($route)
    {
        return Sheet::whereRoute($route)->first()->id;
    }

    protected function getObjectSheetId()
    {
        return ObjectType::whereType('sheet')->first()->id;
    }

    protected function getBindingTypeId($type)
    {
        return BindingType::whereType($type)->first()->id;
    }

    protected function getObjectTypeId()
    {
        return ObjectType::whereModel($this->model->getMorphClass())->first()->id;
    }

}