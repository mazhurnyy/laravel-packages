<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\File;

/**
 * Class FileDeleting
 * @package Mazhurnyy\Events
 */
class FileDeleting extends SomeEvent
{
    public $changed;

    /**
     * FileDeleting constructor.
     *
     * @param File $changed
     */
    public function __construct(File $changed)
    {
        $this->changed = $changed;
    }
}
