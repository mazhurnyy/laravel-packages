<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\StatusTranslation;

/**
 * Class StatusTranslationDeleting
 * @package Mazhurnyy\Events
 */
class StatusTranslationDeleting extends SomeEvent
{
    public $changed;

    /**
     * EssenceTranslationDeleting constructor.
     * @param StatusTranslation $changed
     */
    public function __construct(StatusTranslation $changed)
    {
        $this->changed = $changed;
    }
}