<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\SheetTranslation;

/**
 * Class SheetTranslationDeleting
 * @package Mazhurnyy\Events
 */
class SheetTranslationDeleting extends SomeEvent
{
    public $changed;

    /**
     * SheetTranslationDeleting constructor.
     * @param SheetTranslation $changed
     */
    public function __construct(SheetTranslation $changed)
    {
        $this->changed = $changed;
    }
}