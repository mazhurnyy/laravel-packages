<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:16
 */

namespace App\FileProcessing\Traits;

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
     *
     */
    protected function addFileInfo()
    {
        $model = $this->essenceType->model::find($this->id);
        $model->increment('images');
        $this->file_model = File::create(
            [
                'token' => $this->token,
                'size' => $this->size,
                'extension_id' => $this->extensions_id,
                'order' => $model->images,
                'alias' => $model->alias,
            ]
        );
        Fileable::create(
            [
                'file_id' => $this->file_model->id,
                'fileable_type' => $this->essenceType->model,
                'fileable_id' => $model->id,
            ]
        );
    }

    protected function addFileVersion()
    {
        FileVersion::create(
            [
                'file_id' => $this->file_model->id,
                'prefix' => $this->img_settings->prefix,
            ]
        );
    }

    protected function deleteFile()
    {

// todo пока количество неуменьшаем, проблема с сортировкой
        //       $model = $this->essenceType->model::find($this->id);
        //       $model->decrement('images');

        File::destroy($this->file_id);
    }
}