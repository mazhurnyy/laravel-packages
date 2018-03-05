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

    /**
     * сортировка файлов
     *
     * @param $file
     * @param $shift
     */
    private function shiftFile($file, $shift)
    {
        $file_beside = File::fileObject($this->objectType->model, $this->id)
            ->whereOrder($file->order + $shift)
            ->withTrashed()
            ->first();
        if ($shift > 0)   // перемещаем вверх
        {
            $file_beside->order = $file_beside->order - 1;
            $file_beside->save();
            $file->increment('order');
        } else    // перемещаем вниз
        {
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
    private function validatorFile(array $data)
    {
        return Validator::make(
            $data, [
                     'file' => 'mimes:' . implode(',', array_collapse($this->type_files)),
                 ]
        );
    }





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