<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:16
 */

namespace Mazhurnyy\FileProcessing;

use Illuminate\Support\Facades\Validator;
use Mazhurnyy\FileProcessing\Traits\FileTraits;
use Mazhurnyy\FileProcessing\Traits\ImgTrait;
use Mazhurnyy\FileProcessing\Traits\ModelTrait;
use Mazhurnyy\Models\File;

/**
 * Class SaveFile
 * работа с файлами, запись, удаление, переименование, перемещение
 *
 * @package App\Services
 */
class FileProcessing
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
     * @var object объект текущего типа сущности
     */
    protected $objectType;

    /**
     * @var array типы возможных файлов
     */
    protected $type_files;

    protected $storage;
    /**
     * @var int размер файла в байтах
     */
    protected $size;


    public function __construct()
    {
        $this->storage = new StorageConnect();
        $this->setType();
        $this->setId();
        $this->getObjectType();
        $this->type_files = config('mazhurnyy.type_files');
    }


    /**
     * добавление файла
     */
    public function fileAdd()
    {
        $this->setFile();
        $ext = $this->getExt();
        $this->validatorFile(request()->all())->validate();

        foreach ($this->type_files AS $key => $type)
        {
            if (in_array($ext, $type))
            {
                $this->$key();
            }
        }

        return back();
    }


    /**
     * мягкое удаление файла
     */
    public function fileDelete()
    {
        $this->setFileId();
        $this->deleteFile();

        return back();
    }

    /**
     * сортировка файлов сущности
     */
    public function fileOrder()
    {
        $this->setFileId();
        $this->setDirection();
        $file = $this->getFileInfo(); // информация о текущем файле

        $images = $this->objectType->model::whereId($this->id)->firstOrFail()->images;
        if ($this->direction == 'left' && $file->order > 1)
        {
            $this->shiftFile($file, -1);
        } elseif ($this->direction == 'right' && $file->order < $images)
        {
            $this->shiftFile($file, 1);
        }
    }


    /**
     * обрабатывем рисунок, конвертируем в  jpg и сохраняем на диск и делаем запись в базу
     */
    private function images()
    {
        $this->getExtensionId('jpg');
        $this->setToken();
        $this->size = $this->imgProcessing();
    }

    private function shiftFile($file, $shift)
    {
        $file_beside = File::fileObject($this->objectType->model, $this->id)
            ->whereOrder($file->order + $shift)
            ->withTrashed()
            ->first();

        $sql = File::fileObject($this->objectType->model, $this->id)
            ->whereOrder($file->order + $shift)
            ->withTrashed()
            ->toSql();

        if ($shift > 0)   // перемещаем вверх
        {
            $file_beside->order = $file_beside->order - 1;
            $file_beside->save();
            $file->increment('order');
        } else    // перемещаем вниз
        {
            //          $file_beside->increment('order');
            $file_beside->order = $file_beside->order + 1;
            $file_beside->save();
            $file->decrement('order');
        }

        if (!empty($file_beside->deleted_at))
        {
            $this->shiftFile($file, $shift);
        }

    }

    /**
     * Проверка всех доступных типов файлов, указанных в конфиге
     *
     * @param array $data
     *
     * @return mixed
     */
    private function validatorFile(array $data, $mimes = null)
    {
        return Validator::make(
            $data, [
                     'file' => 'mimes:' . implode(',', array_collapse($this->type_files)),
                 ]
        );
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