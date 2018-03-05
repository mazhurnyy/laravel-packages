<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Status;

/**
 * Class StatusSaved
 * @package Mazhurnyy\Events
 */
class StatusSaved extends SomeEvent
{
    public $changed;

    /**
     * CatalogSaved constructor.
     * @param Status $changed
     */
    public function __construct(Status $changed)
    {
        $this->changed = $changed;
    }
}