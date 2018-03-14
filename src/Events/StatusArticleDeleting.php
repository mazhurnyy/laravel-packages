<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\StatusArticle;

/**
 * Class StatusArticleDeleting
 * @package Mazhurnyy\Events
 */
class StatusArticleDeleting extends SomeEvent
{
    public $changed;

    /**
     * StatusArticleDeleting constructor.
     * @param StatusArticle $changed
     */
    public function __construct(StatusArticle $changed)
    {
        $this->changed = $changed;
    }
}
