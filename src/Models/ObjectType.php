<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 06.02.2018
 * Time: 21:14
 */

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

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