<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 05.03.2018
 * Time: 19:47
 */

namespace Mazhurnyy\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

/**
 * Class SaveImg
 * запись изображений
 *
 * @package App\Services
 */
class DeleteTempDir extends StorageConnect implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $tries = 3;
    /**
     * @var string
     */
    private $dirTemp;

    public function __construct($dirTemp)
    {
        $this->dirTemp = $dirTemp;
    }

    /**
     * @param $token string токен файла
     * @param $file
     *
     * @return string
     */
    public function handle()
    {

        Storage::disk('uploads')->deleteDirectory($this->dirTemp);

    }


}