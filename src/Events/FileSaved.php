<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\File;

/**
 * Class FileSaved
 * @package Mazhurnyy\Events
 */
class FileSaved extends SomeEvent
{
    public $changed;

    /**
     * FileSaved constructor.
     *
     * @param File $changed
     */
    public function __construct(File $changed)
    {
        $this->changed = $changed;
    }
}