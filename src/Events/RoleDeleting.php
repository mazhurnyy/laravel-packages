<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Role;

/**
 * Class RoleDeleting
 * @package Mazhurnyy\Events
 */
class RoleDeleting extends SomeEvent
{
    public $changed;

    /**
     * RoleDeleting constructor.
     * @param Role $changed
     */
    public function __construct(Role $changed)
    {
        $this->changed = $changed;
    }
}
