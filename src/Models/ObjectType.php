<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 06.02.2018
 * Time: 21:14
 */

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Mazhurnyy\Events\ObjectTypeSaved;
use Mazhurnyy\Events\ObjectTypeDeleting;

class ObjectType extends Model
{

    protected $table = 'object_types';

    protected $fillable = ['type', 'note'];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved' =>ObjectTypeSaved::class,
        'deleting' =>ObjectTypeDeleting::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prefix()
    {
        return $this->hasMany('Mazhurnyy\Models\Prefix','object_type_id');
    }

    public function sheet()
    {
        return $this->hasMany('Mazhurnyy\Models\Sheet','object_type_id');
    }

    public function map()
    {
        return $this->hasMany('Mazhurnyy\Models\Map','object_type_id');
    }

    /**
     * выбираем только статьи
     * @param $query
     * @return mixed
     */
    public function scopeSelectType($query)
    {
        return $query->select('id','type');
    }
}