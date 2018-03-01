<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 19.11.2017
 * Time: 1:30
 */

namespace App\Services\Change;

use App\Models\PersonPhoto;
use App\Services\StorageConnect;
use Carbon\Carbon;

trait UpdateImg
{

    /**
     * обновляем ссылку на фото персоны, старую удаляем
     */
    private function updateUrlPhotoPerson()
    {
        $params_link  = [
            'contentType' => 'x-storage/symlink',
            'contentDisposition' => 'inline',
            'contentLength' => 0,
            'deleteAfter' => '',
            'metaLocation' => '',
        ];
        $person_photo = PersonPhoto::find($this->model->getAttributeValue('id'));
        $person_photo->updated_at = Carbon::now();

        $storage     = new StorageConnect();
        $person_id_8 = str_pad($person_photo->person_id, 8, "0", STR_PAD_LEFT);
        $path_photo  = 'persons/' . $this->getPartUrl($person_id_8) . $person_id_8 . '.jpg';
        $photo_old                   = $person_photo->person->alias . '.jpg';

        if ($storage->container_links_persons->files()->exists($photo_old))
        {
            $person_photo->save();
            $params_link['metaLocation'] = '/images/' . $path_photo;
            $photo_new                   = $person_photo->person->alias . '-' . $person_photo->updated_at->timestamp . '.jpg';
            $storage->container_links_persons->uploadFromStream($photo_new, '', $params_link);
            $file = $storage->container_links_persons->files()->find($photo_old);
            $file->delete();
        }
    }

}