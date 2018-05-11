<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\SheetTranslation;

/**
 * Class SheetTranslationSaved
 * @package Mazhurnyy\Events
 */
class SheetTranslationSaved extends SomeEvent
{
    public $changed;

    /**
     * DeliverySaved constructor.
     * @param SheetTranslation $changed
     */
    public function __construct(SheetTranslation $changed)
    {
        $this->changed = $changed;
    }
}