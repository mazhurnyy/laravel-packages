<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 19.11.2017
 * Time: 0:47
 */

namespace Mazhurnyy\Listeners;

use Mazhurnyy\Events\SomeEvent;
use Mazhurnyy\Services\Change\UpdateMap;

/**
 * @package App\Listeners
 */
class DeleteMap extends SomeEvent
{
    use UpdateMap;

    /**
     * @param  SomeEvent $event
     * @return void
     */
    public function handle(SomeEvent $event)
    {

            $this->deleteMap($event->changed);

    }

}