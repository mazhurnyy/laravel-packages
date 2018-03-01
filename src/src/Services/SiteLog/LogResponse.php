<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 11.11.2017
 * Time: 2:05
 */

namespace App\Services\SiteLog;

use App\Models\Response3xx;

/**
 * Class LogResponse
 * Работа с логом редиректов
 *
 * @package App\Services
 */
trait LogResponse
{
    use RedirectModelUrl;
    /**
     * @var object текущая измененная модель
     */
    protected $model;

    /**
     * @var string новый алиас модели
     */
    private $alias;


    /**
     * добавляем запись в лог редиектов 301 при  смене алиаса
     *
     * @param $model object текущая модель
     * @param $alias string новый алиас для модели
     */
    public function logResponse301($model, $alias)
    {
        $this->model = $model;
        $this->alias = $alias;

        foreach ($this->getUrlModel() AS $items)
        {
            $old_response = Response3xx::where('old', $items['old'])->first();
            if (empty($old_response))
            {
                Response3xx::create([
                    'code' => 301,
                    'new' => $items['new'],
                    'old' => $items['old'],
                ]);
            }
            Response3xx::whereNew($items['old'])->update(['new' => $items['new']]);
            Response3xx::whereOld($items['new'])->delete();
        }
    }

    /**
     * Вычисляем старый и новый адресс страницы, при смене алиаса, в зависимости от модели
     * @return array
     */
    private function getUrlModel()
    {
        // разбиваем путь к модели App\Models\..... по слешу - получаем имя метода в [2]
        $method = explode('\\', $this->model->getMorphClass(),3);
        $called_method = 'getUrl' . $method[2];
        return $this->$called_method();
    }


}