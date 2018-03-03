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
use Mazhurnyy\Facades\FileProcessing;
//use RobbieP\CloudConvertLaravel\Facades\CloudConvert;

class FileProcessingController extends Controller
{

    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * добавление файла
     */
    public function fileAdd()
    {
        FileProcessing::fileAdd();

        return back();
    }
    /**
     * мягкое удаление файла
     */
    public function fileDelete()
    {
        FileProcessing::fileDelete();

        return back();
    }

    /**
     * Изменение сортировки слайдов
     */
    /*
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
*/
    /**
     * @param array $data
     *
     * @return mixed
     */
/*
    protected function validatorPresentation(array $data)
    {
        return Validator::make(
            $data, [
                'slide' => 'mimes:jpeg,bmp,png,gif,ppt,pptx,pdf',
            ]
        );
    }
*/
    //--------------------------------------------


    /**
     * конвертация презентации в форматах ppt,pptx,pdf в jpg, запись на диск и в базу данных
     */
    /*
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
*/


}