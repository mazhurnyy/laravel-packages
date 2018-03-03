<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Extension;

/**
 * Class ArticleDeleting
 * @package Mazhurnyy\Events
 */
class ExtensionDeleting extends SomeEvent
{
    public $changed;

    /**
     * ExtensionDeleting constructor.
     * @param Extension $changed
     */
    public function __construct(Extension $changed)
    {
        $this->changed = $changed;
    }
}