<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Mazhurnyy\Events\FileableDeleting;
use Mazhurnyy\Events\FileableSaved;

/**
 * Class Fileable
 * @package App\Models
 */
class Fileable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fileables';


    protected $primaryKey = 'file_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved' => FileableSaved::class,
        'deleting' => FileableDeleting::class,
    ];

    /**
     * @var array
     */
    protected $fillable = ['file_id', 'fileable_id', 'fileable_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function essenceType()
    {
        return $this->belongsTo('Mazhurnyy\Models\ObjectType');
    }

    public function file()
    {
        return $this->belongsTo('Mazhurnyy\Models\File');
    }

}
