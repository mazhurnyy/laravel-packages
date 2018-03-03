<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 19.11.2017
 * Time: 0:47
 */

namespace Mazhurnyy\Listeners;

use Mazhurnyy\Events\SomeEvent;
use Mazhurnyy\Services\Change\RenameAlias;

/**
 * Смена title у модели - меняем alias
 * @package App\Listeners
 */
class ChangeAlias extends SomeEvent
{
    use RenameAlias;

    /**
     * @param  SomeEvent $event
     * @return void
     */
    public function handle(SomeEvent $event)
    {
        if ($event->changed->isDirty('name'))
        {
            $this->changeName($event->changed);
        }
    }


}