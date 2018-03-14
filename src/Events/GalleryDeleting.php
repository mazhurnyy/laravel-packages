<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Gallery;

/**
 * Class GalleryDeleting
 * @package Mazhurnyy\Events
 */
class GalleryDeleting extends SomeEvent
{
    public $changed;

    /**
     * RoleDeleting constructor.
     * @param Gallery $changed
     */
    public function __construct(Gallery $changed)
    {
        $this->changed = $changed;
    }
}
