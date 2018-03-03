<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:16
 */

namespace Mazhurnyy\FileProcessing\Traits;

use App\Models\File;
use App\Models\Fileable;
use App\Models\FileVersion;


/**
 * Class SaveFile
 * запись изображений
 *
 * @package App\Services
 */
trait ModelTrait
{
    /**
     * добавляем запись о файле в базу
     */
    protected function addFileInfo()
    {
        $model = $this->objectType->model::find($this->id);
        $model->increment('images');
        $this->file_model = File::create(
            [
                'token'        => $this->token,
                'size'         => $this->size,
                'extension_id' => $this->extensions_id,
                'order'        => $model->images,
                'alias'        => $model->alias,
            ]
        );
        Fileable::create(
            [
                'file_id'       => $this->file_model->id,
                'fileable_type' => $this->objectType->model,
                'fileable_id'   => $model->id,
            ]
        );
    }

    /**
     * добавляем информацию о версии файла с префиксом, для изображений
     */
    protected function addFileVersion()
    {
        FileVersion::create(
            [
                'file_id' => $this->file_model->id,
                'prefix'  => $this->img_settings->prefix,
                'size'    => $this->size,
            ]
        );
    }

    protected function deleteFile()
    {
        // todo дописать полноен удаление файла по крону
        File::destroy($this->file_id);
    }

    /**
     * получаем информацию о текущем файле по его ид, включая удаленные
     */
    private function getFileInfo()
    {
       return File::whereId($this->file_id)->withTrashed()->first();
    }

    /**
     * получаем ID типа расширения
     *
     * @param $type
     *
     * @return mixed
     */
    protected function getExtensionId($type = null)
    {
        $this->extensions_id = Extension::whereName($type)->first()->id;
    }

    /**
     * получаем модель типа сущности
     */
    protected function getObjectType()
    {
        $this->objectType = ObjectType::whereType($this->type)->firstOrFail();
    }
}