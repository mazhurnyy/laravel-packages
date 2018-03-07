<?php
/**
 * Слушатель изменений при сщздании записи в базу данных
 */

namespace Mazhurnyy\Listeners;

use Mazhurnyy\Events\SomeEvent;
use Mazhurnyy\Services\Logs\LogChanged;

class CreatedDatabase extends SomeEvent
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
        $this->saveLogChange($event->changed);
    }
}
