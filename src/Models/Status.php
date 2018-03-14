<?php

namespace Mazhurnyy\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mazhurnyy\Events\StatusDeleting;
use Mazhurnyy\Events\StatusSaved;

/**
 * @property int    $id
 * @property string $title
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Status extends Model
{
    use Translatable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status';

    protected $dispatchesEvents = [
        'saved'    => StatusSaved::class,
        'deleting' => StatusDeleting::class,
    ];

    /**
     * @var array
     */
    protected $fillable = ['alias', 'note'];

    protected $dates = ['deleted_at'];

    public $translatedAttributes = ['title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statusTranslation()
    {
        return $this->hasMany('Mazhurnyy\Models\StatusTranslation', 'status_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article()
    {
        return $this->hasMany('Mazhurnyy\Models\Article');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statusArticle()
    {
        return $this->hasMany('Mazhurnyy\Models\StatusArticle');
    }

}
