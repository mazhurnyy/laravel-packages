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
 * Смена title у модели - меняем alias
 * @package App\Listeners
 */
class ChangeMap extends SomeEvent
{
    use UpdateMap;

    /**
     * @param  SomeEvent $event
     * @return void
     */
    public function handle(SomeEvent $event)
    {
        if ($event->changed->isDirty('deleted_at') && $event->changed->getAttributeValue('deleted_at') === null){
            $this->restoreMap($event->changed);
        }else
        {
            $this->changeMap($event->changed);
        }
    }


}