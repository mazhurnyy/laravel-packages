<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\Article;

/**
 * Class ArticleDeleting
 * @package Mazhurnyy\Events
 */
class ArticleDeleting extends SomeEvent
{
    public $changed;

    /**
     * ArticleDeleting constructor.
     * @param Article $changed
     */
    public function __construct(Article $changed)
    {
        $this->changed = $changed;
    }
}