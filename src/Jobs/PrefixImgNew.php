<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 27.03.2018
 * Time: 22:29
 */

namespace Mazhurnyy\Jobs;

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

/**
 * Class SaveImg
 * запись изображений
 *
 * @package App\Services
 */
class PrefixImgNew extends StorageConnect implements ShouldQueue
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
        $this->id      = $this->data['id'];
        $this->setFilePath($this->data['path']);
        $this->prefix_id = $this->data['prefix_id'];
        $this->prefixImgNew();
    }


}