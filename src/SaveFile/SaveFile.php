<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:16
 */

namespace Mazhurnyy\SaveFile;


use App\Models\File;
use App\Models\Prefix;
//use App\Traits\File;

use Mazhurnyy\Services\StorageConnect;
use Mazhurnyy\SaveFile\Traits\FileTraits;
use Mazhurnyy\SaveFile\Traits\ImgTrait;
use Mazhurnyy\SaveFile\Traits\ModelTrait;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


/**
 * Class SaveFile
 * работа с файлами, запись, удаление, переименование, перемещение
 *
 * @package App\Services
 */
class SaveFile
{
    use FileTraits, ImgTrait, ModelTrait;
    /**
     * @var string тип сущности
     */
    protected $type;
    /**
     * @var int
     */
    protected $id;
    /**
     * @var object объект типа сущности
     */
    protected $objectType;


    public function __construct()
    {
        $storage = new StorageConnect();
        $this->setType();
        $this->setId();
        $this->getObjectType($this->type);
//        $this->types_file = config('file_processing.types_file');
    }


    /**
     * добавление файла
     */
    public function fileAdd()
    {
        $this->setFile();
        in_array($method = $this->type, $this->types_file) ? $this->$method() : abort(404);

        return back();
    }




//    private $storage;
    /**
     * @var object изображение
     */
//    private $img;
    /**
     * @var string уникальное имя файла
     */
//    private $token;

    /**
     * Путь к файлу
     */
    //   private $path;

    /**
     * @var int ID текущей модели
     */
    /*
       private $id;
       private $type;
       private $size = 0;
       private $jpg_extensions_id;
       private $essence_type_id;
   */
    /**
     * @var array размеры сохраняемой картинки и сжатие
     */
    /*
    private $proportions = [
        'width'   => '',
        'height'  => '',
        'quality' => '90',
    ];
*/


    /**
     * @param $token string токен файла
     * @param $file
     *
     * @return string
     */

    /*
     public function handle($file, $token, $type_id)
     {
         $this->token = $token;

 //        $config      = 'bbmGallery.gallery';
 //        $this->types = config($config);

         $this->proportions = Prefix::whereEssenceTypeId($type_id)->get();

         $this->path = $this->getTokenPath($token) . $token . '.jpg';

         $this->img = Image::make(\File::get($file));

         $size = $this->img->filesize();

         $this->changePhoto();

   //     Storage::disk('temp')->deleteDirectory($this->getTokenPath($token));

         return $size;
     }

     public function deletePhotoGallery($file_id)
     {
         $config      = 'bbmGallery.gallery';
         $this->types = config($config);
         $this->deleteFile($file_id);
         return true;
     }
 */

    // todo переделать

    /**
     * @param $file_id
     */
    /*
    private function deleteFile($file_id)
    {
        $token      = File::find($file_id)->token;
        $this->path = $this->getTokenPath($token) . $token;

        foreach ($this->proportions AS $key => $proportions)
        {
            $url = $proportions['prefix'] . $this->path;
            Storage::disk('galleries')->delete($url);
        }
    }

    private function changePhoto()
    {

        $this->img->backup();
        foreach ($this->proportions AS $key => $proportions)
        {
            $this->proportions = $proportions;
            $this->img->reset();
            $this->updatePhoto();
        }
        $this->img->destroy();
    }
*/
    /**
     * записываем файл с изображениеам на сервер
     * $this->proportions - размеры изображения
     */
    /*
        private function updatePhoto()
        {

            if (!empty($this->proportions['width']))
            {
                // todo сделать еще обрезку по ширине, если больше заданной

    //            $this->img->heighten($this->proportions['height'])->fit($this->proportions['width'], $this->proportions['height']);
                $this->img->heighten($this->proportions['height']);
            }
            $this->img->response('jpg', $this->proportions['quality']); // по умолчанию качество 90
            $url = $this->proportions['prefix'] . $this->path;

    // todo поменять путь хранения картинок

            $params = [
                'contentType'        => 'image/jpeg',
                'contentDisposition' => 'inline',
            ];
            $this->storage->gallery->uploadFromStream($url, $this->img, $params);


        }
    */
}