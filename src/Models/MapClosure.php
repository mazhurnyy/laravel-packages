<?php

namespace Mazhurnyy\Models;

use Franzose\ClosureTable\Models\ClosureTable;

/**
 * @property int $closure_id
 * @property int $ancestor
 * @property int $descendant
 * @property int $depth
 */
class MapClosure extends ClosureTable implements MapClosureInterface
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'maps_closure';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'closure_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['ancestor', 'descendant', 'depth', 'closure_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ancestor()
    {
        return $this->belongsTo('Mazhurnyy\Models\Map', 'id', 'ancestor');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function descendant()
    {
        return $this->belongsTo('Mazhurnyy\Models\Map', 'id', 'descendant');
    }
}