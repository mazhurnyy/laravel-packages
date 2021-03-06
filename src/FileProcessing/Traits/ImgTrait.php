<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:16
 */

namespace Mazhurnyy\FileProcessing\Traits;

use Intervention\Image\ImageManagerStatic as Image;
use Mazhurnyy\Models\Prefix;

/**
 * Class SaveFile
 * запись изображений
 *
 * @package App\Services
 */
trait ImgTrait
{
    /**
     * @var object изображение
     */
    protected $img;
    /**
     * @var object характеристики изображения
     */
    public $img_settings;

    /**
     * @return string
     */
    public function imgProcessing()
    {
        $this->getExtensionId('jpg');
        $this->getPath();
        $this->img = Image::make($this->file);
        $this->size = $this->img->filesize();
        $this->resizePhoto();
        $this->img->destroy();
    }

    /**
     * создаем файлы заданных размеров для текущего типа
     */
    protected function resizePhoto()
    {
        $this->proportions = Prefix::whereObjectTypeId($this->objectType->id)->get();
        $this->img->backup();
        $this->size = $this->img->filesize();
        $this->updatePhoto(); // записываем оригинал

        $this->addFileInfo();
        foreach ($this->proportions AS $key => $proportion) {
            $this->img_settings = $proportion;
            $this->img->reset();
            $this->updatePhoto();
            $this->addFileVersion();
        }
    }

    /**
     * Генерируем новый размер для изображений сущности
     */
    protected function prefixImgNew()
    {
        $this->img_settings = Prefix::find($this->prefix_id);
        $this->getExtensionId('jpg');
        $this->img = Image::make($this->file);
        $this->size = $this->img->filesize();
        $this->file_id = $this->id;
        $this->file_model = $this->getFileInfo();
        $this->getPathFile();
        $this->updatePhoto();
        $this->addFileVersion();
        $this->img->destroy();
    }

    /**
     * записываем файл с изображениеам на диск, указанный в конфиге
     * $this->proportions - размеры изображения
     */
    protected function updatePhoto()
    {
        if (isset($this->img_settings->width)) {
            $this->img->heighten($this->img_settings->height);
            if ($this->img->width() > $this->img_settings->width) {
                $this->img->fit($this->img_settings->width, $this->img_settings->height);
            }
            $path = $this->path . '-' . $this->img_settings->prefix;
            $quality = $this->img_settings->quality;
        } else {
            $path = $this->path;
            $quality = 100;
        }
        $this->img->response('jpg', $quality); // по умолчанию качество 90
        $url = $path . '.jpg';

        $params = [
            'contentType' => 'image/jpeg',
            'contentDisposition' => 'inline',
        ];

        $this->size = $this->storage->saveFile($this->img, $url, $params);

    }

}