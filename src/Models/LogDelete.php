<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $table_id
 * @property string $value
 * @property string $created_at
 * @property Table $table
 */
class LogDelete extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_deletes';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['table_id', 'user_id', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table()
    {
        return $this->belongsTo('Mazhurnyy\Models\Table');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function logDeleteData()
    {
        return $this->hasOne(LogDeleteData::class, 'log_delete_id');
    }

}
