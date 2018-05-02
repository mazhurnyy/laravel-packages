<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 19.11.2017
 * Time: 0:49
 */

namespace Mazhurnyy\Services\Change;

use App\Models\Map;
use App\Models\Sheet;
use Mazhurnyy\Models\ObjectType;
use Mazhurnyy\Services\Blade\SrcTrait;

/**
 * Trait RenameAlias
 * Смена title у модели - меняем alias
 *
 * @package App\Services\Change
 */
trait UpdateMap
{
    use SrcTrait;

    /**
     * Изменился title в модели - меняем алиас (alias) модели
     *
     * @param object $model
     */

    /**
     * @var object измененная модель
     */
    private $model;

    private $object_type_id;

    /**
     * @var int ид модели уникальных разделов
     */
    private $sheet_object_type_id;

    /**
     * @var object информация о родителе в карте сайта
     */
    private $parent = null;

    public function changeModel($model)
    {
        $this->changeMap($model);
    }


    public function changeMap($model)
    {
        $this->model = $model;
        $this->getSheetId();
        $this->getObjectTypeId();
        $this->getParent();
        $map                 = Map::updateOrCreate(
            [
                'object_type_id' => $this->object_type_id,
                'object_id'      => $this->model->id,
            ],
            [
                'route'      => $this->getRoute(),
                'alias'      => $this->getAlias(),
                'real_depth' => $this->getRealDepth(),
                'parent_id'  => $this->getParentId(),
                'src'        => $this->smMap($this->model),
            ]
        );
        $map->{'title:ru'}   = $this->model->{'title:ru'};
        $map->{'title:uk'}   = $this->model->{'title:uk'};
        $map->{'preview:ru'} = $this->model->{'preview:ru'};
        $map->{'preview:uk'} = $this->model->{'preview:uk'};

        $map->save();
    }

    /**
     * удаление записи в карте сайта
     *
     * @param $model
     */
    public function deleteMap($model)
    {
        $this->model = $model;
        $this->getObjectTypeId();
            Map::where('object_type_id', $this->object_type_id)->where('object_id', $model->id)->delete();

    }

    public function restoreMap($model)
    {
        $this->model = $model;
        $this->getObjectTypeId();

            Map::withTrashed()->where('object_type_id', $this->object_type_id)->where('object_id', $model->id)
                ->restore();
    }

    /**
     * ищем родительский раздел
     */
    protected function getParent()
    {
        $sheet = Sheet::whereObjectTypeId($this->object_type_id)->first();

        if (isset($this->model->parent_id))
        {
            if ($this->object_type_id == $this->sheet_object_type_id)
            {
                $this->parent = Map::whereObjectTypeId($sheet->object_type_id)
                    ->whereObjectId($this->model->parent_id)
                    ->first();

            } else // пример - сувенир есть parent_id на каталог связь через Sheet
            {
                $this->parent = Map::whereObjectTypeId($sheet->parent_type_id)
                    ->whereObjectId($this->model->parent_id)
                    ->first();
            }
        } else
        { //  к примеру каталог, нет вложений, строго один родитель, ищем по Sheet
            if ($this->object_type_id <> $this->sheet_object_type_id)
            {
                $this->parent = Map::whereObjectTypeId($sheet->parent_type_id)
                    ->whereObjectId($sheet->id)
                    ->first();
            }
        }

    }

    /**
     *
     */
    protected function getObjectTypeId()
    {
        $this->object_type_id = ObjectType::whereModel($this->model->getMorphClass())->first()->id;
    }

    /**
     * возвращаем роут модели
     */
    private function getRoute($route = null)
    {
        if (isset($this->model->route))
        {
            $route = $this->model->route;
        } elseif (empty($this->model->sheet_id))
        {
            $route = Sheet::whereObjectTypeId($this->object_type_id)->first()->route;

        } else
        {
            $route = Sheet::find($this->model->sheet_id)->route;
        }

        return $route;
    }

    /**
     * Алиас раздела
     *
     * @return null
     */
    private function getAlias()
    {
        return $this->model->alias ? $this->model->alias : null;
    }

    private function getRealDepth()
    {
        $real_depth = $this->getParentRealDepth();

        if (isset($this->model->real_depth))
        {
            if (empty($this->model->sheet_id))
            {
                $real_depth += $this->model->real_depth;
            } else
            {
                $real_depth += $this->model->real_depth + 1;
            }
        }

        return $real_depth;
    }


    private function getParentId()
    {
        return $this->parent ? $this->parent->id : null;

    }

    private function getParentRealDepth()
    {
        return $this->parent ? $this->parent->real_depth : 0;

    }

    /**
     * находим ид модели уникальных разделов
     */
    private function getSheetId()
    {
        $this->sheet_object_type_id = ObjectType::whereType('sheet')->first()->id;
    }

}