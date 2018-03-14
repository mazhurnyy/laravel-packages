<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 19.11.2017
 * Time: 0:49
 */

namespace Mazhurnyy\Services\Change;

use Mazhurnyy\Services\Logs\LogResponse;
use Mazhurnyy\Traits\Converter;


/**
 * Trait RenameAlias
 * Смена title у модели - меняем alias
 *
 * @package App\Services\Change
 */
trait RenameAlias
{
    use LogResponse, Converter;

    /**
     * Изменился title в модели - меняем алиас (alias) модели
     * @param object $model
     */
    public function changeName($model)
    {
        $class  = $model->getMorphClass();
        $items        = $class::find($model->getAttributeValue('id'));
        $items->alias = $this->str2url($model->getAttributeValue('name'));
        $items->save();
        
        // todo logResponse301 ???
  //      $this->logResponse301($model, $items->alias);
    }
}