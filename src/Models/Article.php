<?php

namespace Mazhurnyy\Models;

use Mazhurnyy\Events\ArticleDeleting;
use Mazhurnyy\Events\ArticleSaved;
use Dimsav\Translatable\Translatable;
use Franzose\ClosureTable\Models\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;
use SleepingOwl\Admin\Traits\OrderableModel;

/**
 * Модель сущности универсальная
 *
 * @property int $id
 * @property int $status_id
 * @property string $name
 * @property string $alias
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Article extends Entity
{
    use OrderableModel, Translatable, SoftDeletes;

    protected $table = 'articles';

    public $translationModel = 'App\Models\ArticleTranslation';
    public $translationForeignKey = 'article_id';

    protected $with = ['translations'];
    /**
     * @var array
     */
    protected $fillable = ['parent_id','status_id', 'position', 'real_depth','images','name', 'alias', 'note',
                           'created_at', 'updated_at', 'deleted_at'];

    protected $dispatchesEvents = [
        'saved'    => ArticleSaved::class,
        'deleting' => ArticleDeleting::class,
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $translatedAttributes = ['title', 'preview', 'text', 'keywords', 'description'];


    public $timestamps = true;

    protected $appends = ['photo','type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('Mazhurnyy\Models\Status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function objectType()
    {
        return $this->belongsTo('Mazhurnyy\Models\ObjectType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleTranslation()
    {
        return $this->hasMany('Mazhurnyy\Models\ArticleTranslation');
    }

    /**
     * Get order field name.
     * @return string
     */
    public function getOrderField()
    {
        return 'position';
    }

    public function getPhotoAttribute()
    {
    }

    public function getTypeAttribute()
    {
  //      return $this->essenceType()->type;
    }

    /**
     * выбираем только опубликованные статьи
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        $query->whereHas('status', function ($q) {
            return $q->where('alias', '=', 'published');
        });

// пока оставим для примера, может пригодится
//      $status_id = StatusEssence::whereTitle('Опубликовано')->first()->id;
//    return $query->whereStatusArticleId($status_id);
    }

    /**
     * выбираем только статьи в архиве
     * @param $query
     * @return mixed
     */
    public function scopeArchive($query)
    {
        $query->whereHas('status', function ($q) {
            return $q->where('alias', '=', 'draft');
        });
    }

    /**
     * выбираем только статьи
     * @param $query
     * @return mixed
     */
    public function scopeArticle($query)
    {
        $query->whereHas('essenceType', function ($q) {
            return $q->where('type', '=', 'article');
        });
    }


}
