<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Mazhurnyy\Events\StatusArticleSaved;
use Mazhurnyy\Events\StatusArticleDeleting;
use Illuminate\Database\Eloquent\SoftDeletes;
use \SleepingOwl\Admin\Traits\OrderableModel;

/**
 * @property int $id
 * @property int $order
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class StatusArticle extends Model
{
    use OrderableModel, SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'status_article';

    protected $dispatchesEvents = [
        'saved' =>StatusArticleSaved::class,
        'deleting' => StatusArticleDeleting::class,
    ];

    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['order'];

    public function getOrderField()
    {
        return 'order';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('Mazhurnyy\Models\Status');
    }

 }
