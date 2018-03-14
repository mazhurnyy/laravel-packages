<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FileVersion
 * @package Mazhurnyy\Models
 */
class FileVersion extends Model
{
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
    protected $fillable = ['file_id', 'prefix','size'];

    public function file()
    {
        return $this->belongsTo('Mazhurnyy\Models\File');
    }

}
