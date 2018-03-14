<?php

namespace Mazhurnyy\Events;

use Mazhurnyy\Models\ArticleTranslation;

/**
 * Class ArticleTranslationSaved
 * @package Mazhurnyy\Events
 */
class ArticleTranslationSaved extends SomeEvent
{
    public $changed;

    /**
     * ArticleTranslationSaved constructor.
     *
     * @param ArticleTranslation $changed
     */
    public function __construct(ArticleTranslation $changed)
    {
        $this->changed = $changed;
    }


}