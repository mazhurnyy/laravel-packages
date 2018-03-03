<?php

namespace Mazhurnyy\FileProcessing\Traits;

use App\Models\ObjectType;
use App\Models\Extension;
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
     * @var object модель нового файла
     */
//    public $file_model;

//    protected $dirTemp;


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

    /**
     * получаем экземпляр файла
     */
    private function setFile()
    {
        $this->file = Input::file('file');
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
            substr($token, 4, 2) == 'AD') {
            $this->setToken();
        }
        $this->token = $token;
    }

    /*
    protected function setDirTemp()
    {
        $this->dirTemp = strtoupper(md5(uniqid(rand(), true)));
    }
*/

    /**
     * получаем ID типа расширения
     *
     * @param $type
     *
     * @return mixed
     */
    protected function getExtensionId($type = null)
    {
        $this->extensions_id = Extension::whereName($type)->first()->id;
    }

    /**
     * получаем модель типа сущности
     * @param $type
     *
     * @return mixed
     */
    protected function getObjectType($type)
    {
        $this->objectType = ObjectType::whereType($type)->firstOrFail();
    }

    /**
     * путь к файлу на диске
     */
    private function getPath()
    {
        $this->path = $this->getTokenPath($this->token) . $this->token . '/' . $this->getAlias();
    }

    /**
     * получить алиас объекта
     * @return mixed
     */
    private function getAlias()
    {
        return  $this->objectType->model::find($this->id)->alias;
    }



}
