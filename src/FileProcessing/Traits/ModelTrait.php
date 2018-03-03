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
}