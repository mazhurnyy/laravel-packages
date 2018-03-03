<?php

namespace Mazhurnyy\Models;

use Mazhurnyy\Events\FileDeleting;
use Mazhurnyy\Events\FileSaved;
use Mazhurnyy\FileProcessing\Traits\FileTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class File
 *
 * @package App\Models
 */
class File extends Model
{
    use FileTraits, SoftDeletes;

    protected $table = 'files';

    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved' => FileSaved::class,
        'deleting' => FileDeleting::class,
    ];
    protected $dates            = ['deleted_at'];
    /**
     * @var array
     */
    protected $fillable = [
        'token',
        'name',
        'alias',
        'gallery_id',
        'extension_id',
        'order',
        'size',
        'created_at',
        'deleted_at',
    ];

    protected $appends = [
        'src_thumb',
        'src_preview',
        'src_full',
    ];

    public function filetables()
    {
        return $this->morphTo();
    }

    public function file()
    {
        return $this->hasOne('Mazhurnyy\Models\Fileable');
    }

    public function fileVersion()
    {
        return $this->hasOne('Mazhurnyy\Models\FileVersion');
    }
    public function galleries()
    {
        return $this->morphedByMany('App\Models\Gallery', 'fileable');
    }

    public function extension()
    {
        return $this->belongsTo('Mazhurnyy\Models\Extension');
    }

    // todo пути к файлам раскручавать в цикле
    
    public function getSrcThumbAttribute($value)
    {
        return config('tznp.image_gallery') . $this->getTokenPath(
                $this->token
            ) . $this->token . '/' . $this->alias . '-160x90.' .
            $this->extension->name;
    }

    public function getSrcPreviewAttribute($value)
    {
        return config('tznp.image_gallery') . $this->getTokenPath(
                $this->token
            ) . $this->token . '/' . $this->alias . '-640x360.' . $this->extension->name;
    }

    public function getSrcFullAttribute($value)
    {
        return config('tznp.image_gallery') . $this->getTokenPath(
                $this->token
            ) . $this->token . '/' . '-1920x1080.' . $this->extension->name;
    }

    /**
     * @param $query
     * @param $model
     * @param $model_id
     */
    public function scopeFileEssence($query, $model, $model_id)
    {
        $query->whereHas(
            'file', function ($q) use ($model, $model_id)
            {
            return $q->where('fileable_type', '=', $model)->where('fileable_id', '=', $model_id);
            }
        );
    }

}
