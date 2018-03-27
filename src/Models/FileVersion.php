<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FileVersion
 *
 * @package Mazhurnyy\Models
 */
class FileVersion extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'file_versions';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['file_id', 'prefix', 'size', 'deleted_at'];

    public function file()
    {
        return $this->belongsTo('Mazhurnyy\Models\File');
    }

}
