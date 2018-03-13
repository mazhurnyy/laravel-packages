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
     * Изменение сортировки слайдов
     */
    public function fileOrder()
    {
        FileProcessing::fileOrder();

        return back();
    }
    

}