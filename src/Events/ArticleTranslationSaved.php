<?php

namespace App\Events;

use App\Models\ArticleTranslation;

/**
 * Class ArticleTranslationSaved
 * @package App\Events
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