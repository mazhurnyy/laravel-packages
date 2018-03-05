<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mazhurnyy\Events\GalleryDeleting;
use Mazhurnyy\Events\GallerySaved;

/**
 * @property int          $id
 * @property int          $order
 * @property string       $title
 * @property string       $images
 * @property Department[] $departments
 */

/**
 * Class Gallerie
 *
 * @package App\Models
 */
class Gallery extends Model
{
    use SoftDeletes;

    protected $table = 'galleries';

    protected $dispatchesEvents = [
        'saved'    => GallerySaved::class,
        'deleting' => GalleryDeleting::class,
    ];
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'images', 'created_at', 'updated_at', 'deleted_at', 'used_at'];

    protected $dates = ['used_at', 'deleted_at'];

    protected $appends = [
        'deleted',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function files()
    {
        return $this->morphToMany('Mazhurnyy\Models\File', 'fileable')->withTrashed();
    }

    public function getDeletedAttribute($value)
    {
        if ($this->deleted_at)
        {
            return $this->deleted_at->addMonth();
        }
    }

    /**
     * @param     $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMy($query)
    {
        return $query->whereUserId(\Auth::id());
    }

    public function scopeOrderName($query)
    {
        return $query->orderBy('name','asc');
    }

}
