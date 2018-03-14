<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Fileable;

/**
 * Class FileableDeleting
 * @package Mazhurnyy\Events
 */
class FileableDeleting extends SomeEvent
{
    public $changed;

    /**
     * FileableDeleting constructor.
     *
     * @param Fileable $changed
     */
    public function __construct(Fileable $changed)
    {
        $this->changed = $changed;
    }
}
