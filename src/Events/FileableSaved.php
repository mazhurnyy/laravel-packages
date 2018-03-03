<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Fileable;

/**
 * Class FileableSaved
 * @package Mazhurnyy\Events
 */
class FileableSaved extends SomeEvent
{
    public $changed;

    /**
     * FileableSaved constructor.
     *
     * @param Fileable $changed
     */
    public function __construct(Fileable $changed)
    {
        $this->changed = $changed;
    }
}