<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Status;

/**
 * Class StatusDeleting
 * @package Mazhurnyy\Events
 */
class StatusDeleting extends SomeEvent
{
    public $changed;

    /**
     * CatalogDeleting constructor.
     * @param Status $changed
     */
    public function __construct(Status $changed)
    {
        $this->changed = $changed;
    }
}