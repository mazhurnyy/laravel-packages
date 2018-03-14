<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Role;

/**
 * Class RoleSaved
 * @package Mazhurnyy\Events
 */
class RoleSaved extends SomeEvent
{
    public $changed;

    /**
     * RoleSaved constructor.
     * @param Role $changed
     */
    public function __construct(Role $changed)
    {
        $this->changed = $changed;
    }
}