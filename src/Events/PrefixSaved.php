<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Prefix;

/**
 * Class PrefixSaved
 * @package Mazhurnyy\Events
 */
class PrefixSaved extends SomeEvent
{
    public $changed;

    /**
     * PrefixSaved constructor.
     * @param Prefix $changed
     */
    public function __construct(Prefix $changed)
    {
        $this->changed = $changed;
    }
}