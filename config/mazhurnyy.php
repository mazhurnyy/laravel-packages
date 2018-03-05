<?php
/**
 *  конфиг для универсального пакета
 */

return [

    'storage_driver'=>'selectel',
    'storage_driver_temp'=>'selectel',

    'disks' => [
        'selectel' => [
            'username' => env('SELECTEL_USERNAME'),
            'password' => env('SELECTEL_PASSWORD'),
            'container' => env('SELECTEL_CONTAINER'),
            'url'=> env('SELECTEL_URL')
        ],
        'selectel_temp' => [
            'username' => env('SELECTEL_USERNAME'),
            'password' => env('SELECTEL_PASSWORD'),
            'container_temp' => env('SELECTEL_CONTAINER'),
            'url'=> env('SELECTEL_URL')
        ],
    ],


    // типы обрабатываемых файлов
    'type_files' => [
        // - презентации
        'presentation'=> [
            'ppt',
            'pptx',
            'pdf'
        ],
        // - изображение
        'images'=>[
            'jpg',
            'jpeg',
            'gif',
            'png',
            'bmp'
        ],
    ],




];