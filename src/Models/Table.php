<?php

namespace Mazhurnyy\Models;

use Mazhurnyy\Events\TableDeleting;
use Mazhurnyy\Events\TableSaved;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $note
 * @property LogChanged[] $logChangeds
 * @property LogDelete[] $logDeletes
 * @property LogFile[] $logFile
 */
class Table extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tables';

    /**
     * @var array
     */
    protected $fillable = ['title', 'note'];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved' => TableSaved::class,
        'deleting' => TableDeleting::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logChanged()
    {
        return $this->hasMany('Mazhurnyy\Models\LogChanged');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logDeletes()
    {
        return $this->hasMany('Mazhurnyy\Models\LogDelete');
    }

}
