<?php

namespace Mazhurnyy\Models;

use Mazhurnyy\Events\SheetDeleting;
use Mazhurnyy\Events\SheetSaved;
use Dimsav\Translatable\Translatable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Catalog
 * @package App\Models
 */
class Sheet extends Model
{
    use Translatable, SoftDeletes, Filterable;

    protected $table = 'sheets';

    public $translationModel = 'Mazhurnyy\Models\SheetTranslation';

    public $translationForeignKey = 'sheet_id';

    protected $with = ['translations'];

    public $translatedAttributes = ['title', 'preview', 'text', 'keywords', 'description'];
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'route',
        'images',
        'note',
        'order',
        'object_type_id',
        'parent_type_id',
        'parent_id',
        'visibility',
    ];

    protected $dispatchesEvents = [
        'saved' => SheetSaved::class,
        'deleting' => SheetDeleting::class,
    ];

    protected $dates = ['deleted_at'];

    public function article()
    {
        return $this->hasMany('Mazhurnyy\Models\Article');
    }

    public function objectType()
    {
        return $this->belongsTo('Mazhurnyy\Models\ObjectType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sheetTranslation()
    {
        return $this->hasMany('Mazhurnyy\Models\SheetTranslation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function files()
    {
        return $this->morphToMany('Mazhurnyy\Models\File', 'fileable')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function filesActual()
    {
        return $this->morphToMany('Mazhurnyy\Models\File', 'fileable');
    }

}
