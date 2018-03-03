<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\User;

/**
 * Class UserSaved
 * @package Mazhurnyy\Events
 */
class UserSaved extends SomeEvent
{
    public $changed;

    /**
     * UserSaved constructor.
     * @param User $changed
     */
    public function __construct(User $changed)
    {
        $this->changed = $changed;
    }
}