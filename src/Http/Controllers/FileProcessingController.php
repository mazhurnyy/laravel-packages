<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 20.02.2018
 * Time: 15:18
 */

namespace Mazhurnyy\Http\Controllers;

use App\Http\Controllers\Controller;
use Mazhurnyy\Facades\FileProcessing;

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
     * Воостановление удалённого файла из корзины
     */
    public function fileRestore()
    {
        FileProcessing::fileRestore();

        return back();
    }

    /**
     * Изменение сортировки слайдов
     */
    public function fileOrder()
    {
        FileProcessing::fileOrder();

        return back();
    }

    /**
     * Установка сессии с фильтром галереи
     */
    public function fileFilter()
    {
        $filter = request()->input('filter');

        request()->session()->put('gallery_filter', $filter);

        return request()->ajax() ? 1 : back();
    }
}