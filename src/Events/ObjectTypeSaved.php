<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\ObjectType;

/**
 * Class ObjectType
 *
 * @package Mazhurnyy\Events
 */
class ObjectTypeSaved extends SomeEvent
{
    public $changed;

    /**
     * @param ObjectType $changed
     */
    public function __construct(ObjectType $changed)
    {
        $this->changed = $changed;

    }


}