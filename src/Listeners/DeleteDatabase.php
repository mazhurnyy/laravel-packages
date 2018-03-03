<?php

namespace Mazhurnyy\Listeners;

use Mazhurnyy\Events\SomeEvent;
use Mazhurnyy\Services\SiteLog\LogDelete;

/**
 * Class DeleteDatabase
 * @package Mazhurnyy\Listeners
 */
class DeleteDatabase extends SomeEvent
{
    use LogDelete;

    /**
     * @param SomeEvent $event
     */
    public function handle(SomeEvent $event)
    {
        $this->saveLogDelete($event->changed);
    }
}
