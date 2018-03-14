<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\StatusArticle;

/**
 * Class StatusArticleSaved
 * @package Mazhurnyy\Events
 */
class StatusArticleSaved extends SomeEvent
{
    public $changed;

    /**
     * StatusArticleSaved constructor.
     * @param StatusArticle $changed
     */
    public function __construct(StatusArticle $changed)
    {
        $this->changed = $changed;
    }
}
