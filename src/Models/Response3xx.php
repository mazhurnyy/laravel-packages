<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property boolean $code
 * @property string $old
 * @property string $new
 * @property string $created_at
 * @property string $used_at
 */
class Response3xx extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'response_3xx';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['code', 'old', 'new', 'created_at', 'used_at'];

}
