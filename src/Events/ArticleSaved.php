<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Article;

/**
 * Class ArticleSaved
 * @package Mazhurnyy\Events
 */
class ArticleSaved extends SomeEvent
{
    public $changed;

    /**
     * ArticleSaved constructor.
     *
     * @param Article $changed
     */
    public function __construct(Article $changed)
    {
        $this->changed = $changed;

    }


}