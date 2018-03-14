<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 02.12.2017
 * Time: 13:16
 */

namespace Mazhurnyy\Jobs;

//use App\Models\Extension;
//use App\Models\Gallery;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mazhurnyy\FileProcessing\StorageConnect;
use Mazhurnyy\FileProcessing\Traits\FileTraits;
use Mazhurnyy\FileProcessing\Traits\ImgTrait;
use Mazhurnyy\FileProcessing\Traits\ModelTrait;
use Mazhurnyy\Traits\Converter;
use Illuminate\Support\Facades\Log;

/**
 * Class SaveImg
 * запись изображений
 *
 * @package App\Services
 */
class ResizeImg extends StorageConnect implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Converter, ImgTrait, ModelTrait, FileTraits;


    public $tries = 3;

    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param $token string токен файла
     * @param $file
     *
     * @return string
     */
    public function handle()
    {
        $this->storage = new StorageConnect();
        $this->type    = $this->data['type'];
        $this->id      = $this->data['id'];
        $this->setFilePath($this->data['path']);

        $this->getObjectType();
        $this->type_files = config('mazhurnyy.type_files');
        $this->setToken();

        $this->imgProcessing();

    }


}