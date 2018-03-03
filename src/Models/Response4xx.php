<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property boolean $code
 * @property string $url
 * @property string $created_at
 * @property string $used_at
 */
class Response4xx extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'response_4xx';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['code', 'url', 'created_at', 'used_at'];

}
