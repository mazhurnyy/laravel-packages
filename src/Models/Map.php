<?php

namespace Mazhurnyy\Models;

use Dimsav\Translatable\Translatable;
use Franzose\ClosureTable\Models\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Maps
 * события не отслеживаем, запись в таблицу только скриптами
 * @package Mazhurnyy\Models
 */
class Map extends Entity
{
    use Translatable, SoftDeletes;

    protected $table = 'maps';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'object_type_id',
        'object_id',
        'real_depth',
        'position',
        'parent_id',
        'src',
        'route',
        'alias',
    ];

    public $translationModel = 'Mazhurnyy\Models\MapTranslation';
    public $translationForeignKey = 'map_id';
    protected $with = ['translations'];
    public $translatedAttributes = ['title', 'preview'];

    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mapTranslation()
    {
        return $this->hasMany('Mazhurnyy\Models\MapTranslation');
    }

    public function objectType()
    {
        return $this->belongsTo('Mazhurnyy\Models\ObjectType');
    }
}