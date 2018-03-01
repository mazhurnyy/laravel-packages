<?php
/**
 *  конфиг для универсального пакета
 */

return [

    'storage_driver'=>'selectel',

    'disks' => [
        'selectel' => [
            'username' => env('SELECTEL_USERNAME'),
            'password' => env('SELECTEL_PASSWORD'),
            'container' => env('SELECTEL_CONTAINER'),
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
        'img'=>[
            'jpg',
            'gif',
            'png',
            'bmp'
        ],
    ],




];