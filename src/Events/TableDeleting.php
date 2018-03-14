<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Table;

/**
 * Class TableDeleting
 * @package Mazhurnyy\Events
 */
class TableDeleting extends SomeEvent
{
    public $changed;

    /**
     * TableDeleting constructor.
     * @param Table $changed
     */
    public function __construct(Table $changed)
    {
        $this->changed = $changed;
    }
}