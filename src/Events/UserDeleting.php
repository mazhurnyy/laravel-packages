<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\User;

/**
 * Class UserDeleting
 * @package Mazhurnyy\Events
 */
class UserDeleting extends SomeEvent
{
    public $changed;

    /**
     * UserDeleting constructor.
     * @param User $changed
     */
    public function __construct(User $changed)
    {
        $this->changed = $changed;
    }
}