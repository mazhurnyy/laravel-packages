<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mazhurnyy\Events\FileDeleting;
use Mazhurnyy\Events\FileSaved;
use Mazhurnyy\FileProcessing\Traits\FileTraits;

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
        'saved'    => FileSaved::class,
        'deleting' => FileDeleting::class,
    ];
    protected $dates = ['deleted_at'];
    /**
     * @var array
     */
    protected $fillable = [
        'token',
        'name',
        'alias',
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
        return $this->hasOne('Mazhurnyy\Models\Fileable', 'file_id', 'id');
    }

    public function fileVersion()
    {
        return $this->hasOne('Mazhurnyy\Models\FileVersion');
    }

    public function objectType()
    {
        return $this->morphedByMany('Mazhurnyy\Models\ObjectType', 'fileable');
    }

    public function gallery()
    {
        return $this->morphedByMany('Mazhurnyy\Models\Gallery', 'fileable')->withTrashed();
    }

    public function extension()
    {
        return $this->belongsTo('Mazhurnyy\Models\Extension');
    }

    // todo пути к файлам раскручавать в цикле

    public function getSrcThumbAttribute($value)
    {
        return $this->getSrcUrl('thumb');
    }

    public function getSrcPreviewAttribute($value)
    {
        return $this->getSrcUrl('preview');    }

    public function getSrcFullAttribute($value)
    {
        return $this->getSrcUrl('full');
    }


    /**
     * @param $query
     * @param $model
     * @param $model_id
     */
    public function scopeFileObject($query, $model, $model_id)
    {
        $query->whereHas('file', function ($q) use ($model, $model_id) {
            return $q->where('fileable_type', '=', $model)->where('fileable_id', '=', $model_id);
        });
    }


    private function getSrcUrl($alias)
    {
        return config('mazhurnyy.image_gallery') . $this->getTokenPath($this->token) . $this->token . '/' . $this->alias . $this->getPrefix($alias) .'.' . $this->extension->name;
    }

    /**
     * получаем префикс по алиасу
     * @param $alias
     * @return string
     */
    private function getPrefix($alias)
    {
        // todo как найти ненаходимое ???
        return '-' . Prefix::whereAlias($alias)->whereObjectTypeId($this->getObjectTypeId())->first()->prefix;
    }

    /**
     * находим ид типа объекта КОРЯВО, как переделать???
     * @return mixed
     */
    private function getObjectTypeId()
    {
        // todo как переделать
        $fileable_type = Fileable::whereFileId($this->id)->first()->fileable_type;

        return ObjectType::whereModel($fileable_type)->first()->id;
    }

}
