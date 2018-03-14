<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Mazhurnyy\Events\ArticleTranslationSaved;
use Mazhurnyy\Events\ArticleTranslationDeleting;

/**
 * @property int $id
 * @property int $article_id
 * @property string $locale
 * @property string $title
 * @property string $preview
 * @property string $text
 * @property string $keywords
 * @property string $description
 */
class ArticleTranslation extends Model
{

    protected $table = 'article_translations';
    /**
     * @var array
     */
    protected $fillable = ['article_id', 'locale', 'title', 'preview', 'text', 'keywords', 'description'];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved'    => ArticleTranslationSaved::class,
        'deleting' => ArticleTranslationDeleting::class,
    ];


}
