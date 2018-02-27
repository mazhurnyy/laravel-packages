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
    'types_file' => [
        'gallery',      // - презентации
        'img',          // - изображение
    ],

    // типы поддерживаемых расширений презентаций
    'presentation' => [
        'ppt',
        'pptx',
        'pdf',
    ],


];