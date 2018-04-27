<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Sheet;

/**
 * Class SheetSaved
 * @package Mazhurnyy\Events
 */
class SheetSaved extends SomeEvent
{
    public $changed;

    /**
     * SheetSaved constructor.
     * @param Sheet $changed
     */
    public function __construct(Sheet $changed)
    {
        $this->changed = $changed;
    }
}