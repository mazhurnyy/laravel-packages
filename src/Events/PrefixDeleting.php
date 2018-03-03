<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Prefix;

/**
 * Class PrefixDeleting
 * @package Mazhurnyy\Events
 */
class PrefixDeleting extends SomeEvent
{
    public $changed;

    /**
     * PrefixDeleting constructor.
     * @param Prefix $changed
     */
    public function __construct(Prefix $changed)
    {
        $this->changed = $changed;
    }
}