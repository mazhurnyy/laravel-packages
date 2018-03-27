<?php

namespace Mazhurnyy\FileProcessing\Traits;

use Illuminate\Support\Facades\Input;

/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 29.04.2017
 * Time: 22:33
 */
trait FileTraits
{
    /**
     * @var int ID файла
     */
    protected $file_id;

    protected $file;
    /**
     * @var string направление сортировки
     */
    protected $direction;

    protected $dirTemp;

    protected $path;

    /**
     * устанавливаем тип объекта
     */
    private function setType()
    {
        $this->type = request()->input('type') ?? null;
    }

    /**
     * ID объекта
     */
    private function setId()
    {
        $this->id = request()->input('id') ?? null;
    }

    private function getId()
    {
        return $this->id;
    }

    private function setFileId()
    {
        $this->file_id = request()->input('file_id') ?? null;
    }

    /**
     * получаем экземпляр файла c Input
     */
    private function setFile()
    {
        $this->file = Input::file('file');
    }

    /**
     * получаем экземпляр файла c Input
     */
    private function setFilePath($path = null)
    {
        if (strstr($path, 'http'))
        {
            $this->file = $path;
        } else
        {
            $this->file = \File::get($path);
        }
    }

    /**
     * направление сортировки
     */
    private function setDirection()
    {
        $this->direction = request()->input('direction') ?? null;
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

    /**
     * возвращаем путь (каталоги) к файлу по токену
     *
     * @param $token
     *
     * @return string
     */
    public function getTokenPath($token)
    {
        return '/' . substr($token, 0, 2) . '/' . substr($token, 2, 2) . '/' . substr($token, 4, 2) . '/';
    }

    /**
     * генерируем уникальный токен для имени файла
     */
    protected function setToken()
    {
        $token = strtoupper(md5(uniqid(rand(), true)));
        if (substr($token, 0, 2) == 'AD' || substr($token, 2, 2) == 'AD' ||
            substr($token, 4, 2) == 'AD')
        {
            $this->setToken();
        }
        $this->token = $token;
    }

    /**
     * генерируем токен для временного каталога
     */
    protected function setDirTemp()
    {
        $this->dirTemp = strtoupper(md5(uniqid(rand(), true)));
    }


    /**
     * путь к файлу на диске
     */
    private function getPath()
    {
        $this->path = $this->getTokenPath($this->token) . $this->token . '/' . $this->getAlias();
    }

    /**
     * поиск пути к файлу по объекту файла
     */
    private function getPathFile()
    {
        $this->path = $this->getTokenPath(
                $this->file_model->token
            ) . $this->file_model->token . '/' . $this->file_model->alias;
    }

    /**
     * получить алиас объекта
     *
     * @return mixed
     */
    private function getAlias()
    {
        return $this->objectType->model::find($this->id)->alias;
    }


}
