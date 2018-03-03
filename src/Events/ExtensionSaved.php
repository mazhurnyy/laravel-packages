<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Extension;

/**
 * Class ArticleSaved
 * @package Mazhurnyy\Events
 */
class ExtensionSaved extends SomeEvent
{
    public $changed;

    /**
     * ExtensionSaved constructor.
     * @param Extension $changed
     */
    public function __construct(Extension $changed)
    {
        $this->changed = $changed;
    }
}