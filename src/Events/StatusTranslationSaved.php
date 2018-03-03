<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\StatusTranslation;

/**
 * Class StatusTranslationSaved
 * @package Mazhurnyy\Events
 */
class StatusTranslationSaved extends SomeEvent
{
    public $changed;

    /**
     * EssenceTranslationSaved constructor.
     *
     * @param StatusTranslation $changed
     */
    public function __construct(StatusTranslation $changed)
    {
        $this->changed = $changed;
    }


}