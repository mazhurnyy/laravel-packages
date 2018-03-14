<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Table;

/**
 * Class TableSaved
 * @package Mazhurnyy\Events
 */
class TableSaved extends SomeEvent
{
    public $changed;

    /**
     * TableSaved constructor.
     * @param Table $changed
     */
    public function __construct(Table $changed)
    {
        $this->changed = $changed;
    }
}
