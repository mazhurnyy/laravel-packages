<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Mazhurnyy\Events\PrefixDeleting;
use Mazhurnyy\Events\PrefixSaved;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $object_type_id
 * @property int $width
 * @property int $height
 * @property int $quality
 * @property string $prefix
 */
class Prefix extends Model
{
    use SoftDeletes;

    protected $table = 'prefixes';

    protected $dispatchesEvents = [
        'saved' =>PrefixSaved::class,
        'deleting' =>PrefixDeleting::class,
    ];
    /**
     * @var array
     */
    protected $fillable = ['object_type_id', 'width', 'height', 'quality', 'prefix'];


    protected $dates = ['deleted_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function objectType()
    {
        return $this->belongsTo('Mazhurnyy\Models\ObjectType','object_type_id','id');
    }
}
