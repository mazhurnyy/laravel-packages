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

    public $translationModel = 'Mazhurnyy\Models\ArticleTranslation';
    public $translationForeignKey = 'article_id';
    public $translatedAttributes = ['title', 'preview', 'text', 'keywords', 'description'];
    protected $with = ['translations'];

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


}
