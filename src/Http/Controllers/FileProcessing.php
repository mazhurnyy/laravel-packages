<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 20.02.2018
 * Time: 15:18
 */

namespace Mazhurnyy\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use RobbieP\CloudConvertLaravel\Facades\CloudConvert;

class FileProcessing extends Controller
{
//    use FileTraits, ImgFileTrait, SaveModelTrait;

    /**
     * @var array типы возможных файлов
     */
//    public $types_file;
    /**
     * @var string драйвер диска для хранения файлов
     */
//    public $storage_driver;
    /**
     * @var string тип сущности
     */
 //   protected $type;
    /**
     * @var string
     */
 //   protected $extensions_id;
    /**
     * @var object
     */
 //   protected $essenceType;
    /**
     * @var int
     */
 //   protected $size = 0;
    /**
     * @var object
     */
 //   protected $file;
 //   protected $file_id;
 //   protected $direction;

    /**
     * constructor
     */
    public function __construct()
    {

 //       $this->storage_driver = config('mazhurnyy.storage_driver');

 //       $this->storage = new StorageConnect();
//        $this->setType();
//        $this->getEssenceType($this->type);
//        $this->types_file = config('file_processing.types_file');

        parent::__construct();
    }

    /**
     * добавление файла
     */
    public function fileAdd()
    {
        \SaveFile::fileAdd();

        return back();
    }


    /**
     * мягкое удаление файла
     */
    public function fileDelete()
    {
        $this->setId();
        $this->setFileId();
        $this->deleteFile();

        return back();
    }


    /**
     * сохранение файлов презентации, отдельные изображения или файл презентации
     */
    protected function gallery()
    {
        $presentation = [
            'ppt',
            'pptx',
            'pdf',
        ];
        $this->validatorPresentation(request()->all())->validate();
        in_array($this->getExt(), $presentation) ? $this->savePresentation() : $this->saveImg();
    }


    /**
     * Изменение сортировки слайдов
     */
    public function fileOrder()
    {
        // todo трабла с удаленными файлами

        $this->setId();
        $this->setFileId();
        $this->setDirection();

        $file    = File::whereId($this->file_id)->withTrashed()->first();
        $essence = $this->essenceType->model::whereId($this->id)->firstOrFail();
        if ($this->direction == 'left' && $file->order > 1)
        {
            $file_beside = File::fileEssence($this->essenceType->model, $this->id)
                ->whereOrder($file->order - 1)
                ->withTrashed()
                ->first();
            if ($file_beside)
            {
                $file_beside->increment('order');
            }
            if ($file)
            {
                $file->decrement('order');
            }
        } elseif ($this->direction == 'right' && $file->order < $essence->images)
        {
            $file_beside = File::fileEssence($this->essenceType->model, $this->id)
                ->whereOrder($file->order + 1)
                ->withTrashed()
                ->first();
            if ($file_beside)
            {
                $file_beside->decrement('order');
            }
            if ($file)
            {
                $file->increment('order');
            }
        }

        return back();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    protected function validatorPresentation(array $data)
    {
        return Validator::make(
            $data, [
                'slide' => 'mimes:jpeg,bmp,png,gif,ppt,pptx,pdf',
            ]
        );
    }

    //--------------------------------------------


    /**
     * конвертация презентации в форматах ppt,pptx,pdf в jpg, запись на диск и в базу данных
     */
    private function savePresentation()
    {
        ini_set('max_execution_time', 6000);
        $this->setDirTemp();
        $this->convertPresentation();
        $files = Storage::disk('uploads')->files($this->dirTemp);
        sort($files, SORT_NATURAL | SORT_FLAG_CASE);
        $path = Storage::disk('uploads')->getDriver()->getAdapter()->getPathPrefix();

        foreach ($files As $file)
        {
            $path_file = $path . $file;
            $this->file = $path_file;
            $this->file = \File::get($path_file);
            $this->saveImg();
        }

        Storage::disk('uploads')->deleteDirectory($this->dirTemp);
    }

    private function convertPresentation()
    {
        Storage::disk('uploads')->makeDirectory($this->dirTemp);

        $path = Storage::disk('uploads')->getDriver()->getAdapter()->getPathPrefix();

        CloudConvert::file($this->file)->to(
            $path . $this->dirTemp . '/temp.jpg'
        );
    }


    /**
     *
     */
    private function saveImg()
    {
        $this->extensions_id = $this->getExtensionId('jpg');
        $this->setToken();
        $this->size = $this->imgProcessing();

    }

}