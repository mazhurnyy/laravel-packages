<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Gallery;

/**
 * Class GallerySaved
 * @package Mazhurnyy\Events
 */
class GallerySaved extends SomeEvent
{
    public $changed;

    /**
     * ArticleSaved constructor.
     * @param Gallery $changed
     */
    public function __construct(Gallery $changed)
    {
        $this->changed = $changed;
    }
}