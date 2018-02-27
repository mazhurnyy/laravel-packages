<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:16
 */

namespace App\FileProcessing\Traits;

use App\Models\Prefix;
use Intervention\Image\ImageManagerStatic as Image;


/**
 * Class SaveFile
 * запись изображений
 *
 * @package App\Services
 */
trait ImgTrait
{


    private $storage;
    /**
     * @var object изображение
     */
    private $img;
    /**
     * @var string уникальное имя файла
     */
    private $token;

    /**
     * Путь к файлу
     */
    private $path;

    /**
     * @var int ID текущей записи
     */
    private $id;


    /**
     * @var string
     */
    //   private $path_img;

    private $jpg_extensions_id;

    /**
     * характеристики изображения
     *
     * @var object
     */
    public $img_settings;

    /**
     * @var array размеры сохраняемой картинки и сжатие
     */
    private $proportions = [
        'width'   => '',
        'height'  => '',
        'quality' => '90',
    ];

    /*
        public function __construct()
        {
            // todo
            |  в файл vendor\argentcrusade\selectel-cloud-storage\src\FileUploader.php добавлены недостающие параметры заголовка
            | 'contentLength'      => 'Content-Length',
            | 'metaLocation'       => 'X-Object-Meta-Location',
            /
        }
    */
    /**
     * @return string
     */
    public function imgProcessing()
    {
        $this->getExtensionId('jpg');
        $this->getPath();
        $this->img = Image::make($this->file);
        $size      = $this->img->filesize();
        $this->resizePhoto();

        //     Storage::disk('temp')->deleteDirectory($this->getTokenPath($token));

        return $size;
    }


    protected function resizePhoto()
    {
        $this->proportions = Prefix::whereEssenceTypeId($this->essenceType->id)->get();
        $this->img->backup();
        $this->updatePhoto(); // записываем оригинал
        $this->addFileInfo();
        foreach ($this->proportions AS $key => $proportion)
        {
            $this->img_settings = $proportion;
            $this->img->reset();
            $this->updatePhoto();
            $this->addFileVersion();
        }
        $this->img->destroy();
    }

    /**
     * записываем файл с изображениеам на сервер
     * $this->proportions - размеры изображения
     */

    protected function updatePhoto()
    {
        if (isset($this->img_settings->width))
        {
            // todo сделать еще обрезку по ширине, если больше заданной
//            $this->img->heighten($this->proportions['height'])->fit($this->proportions['width'], $this->proportions['height']);
            $this->img->heighten($this->img_settings->height);
            $path    = $this->path . '-' . $this->img_settings->prefix;
            $quality = $this->img_settings->quality;
        } else
        {
            $path    = $this->path;
            $quality = 100;
        }
        $this->img->response('jpg', $quality); // по умолчанию качество 90
        $url = $path . '.jpg';

        $params = [
            'contentType'        => 'image/jpeg',
            'contentDisposition' => 'inline',
        ];

        // todo перенести настройки пути в конфиг

        $this->storage->container->uploadFromStream($url, $this->img, $params);
    }


    private function getPath()
    {
        $this->path = $this->getTokenPath($this->token) . $this->token . '/' . $this->getAlias();
    }

    private function getAlias()
    {
        return $this->essenceType->model::find($this->id)->alias;
    }

    /**
     * получаем расширение текущего файла
     *
     * @return mixed
     */
    protected function getExt()
    {
        return $this->file->getClientOriginalExtension();
    }

}