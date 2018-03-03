<?php
/**
 * Слушатель изменений при записи в базу данных
 *
 * Created by PhpStorm.
 * User: BBM
 * Date: 01.04.2017
 * Time: 1:51
 */

namespace Mazhurnyy\Listeners;

use Mazhurnyy\Events\SomeEvent;
use Mazhurnyy\Services\SiteLog\LogChanged;

/**
 * Class ChangeDatabase
 * @package Mazhurnyy\Listeners
 */
class ChangeDatabase extends SomeEvent
{
    use LogChanged;

    /**
     * Отправляем запрос на запись изменений в лог
     *
     * @param  SomeEvent $event
     * @return void
     */
    public function handle(SomeEvent $event)
    {
        /**
         * записываем изменения в базу
         */
        $this->saveLogChange($event->changed);

    }
}
