<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Sheet;

/**
 * Class SheetDeleting
 * @package Mazhurnyy\Events
 */
class SheetDeleting extends SomeEvent
{
    public $changed;

    /**
     * SheetDeleting constructor.
     * @param Sheet $changed
     */
    public function __construct(Sheet $changed)
    {
        $this->changed = $changed;
    }
}