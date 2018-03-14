<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\ArticleTranslation;

/**
 * Class ArticleTranslationDeleting
 * @package Mazhurnyy\Events
 */
class ArticleTranslationDeleting extends SomeEvent
{
    public $changed;

    /**
     * ArticleTranslationDeleting constructor.
     * @param ArticleTranslation $changed
     */
    public function __construct(ArticleTranslation $changed)
    {
        $this->changed = $changed;
    }
}