<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\ObjectType;

/**
 * Class ObjectTypeDeleting
 * @package Mazhurnyy\Events
 */
class ObjectTypeDeleting extends SomeEvent
{
    public $changed;

    /**
     * ArticleDeleting constructor.
     * @param Article $changed
     */
    public function __construct(ObjectType $changed)
    {
        $this->changed = $changed;
    }
}