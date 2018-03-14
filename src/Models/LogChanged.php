<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $table_id
 * @property integer $user_id
 * @property integer $row
 * @property string $column
 * @property string $created_at
 * @property Table $table
 * @property User $user
 * @property LogChangedData $logChangedData
 */
class LogChanged extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_changeds';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['table_id', 'user_id', 'row', 'name', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table()
    {
        return $this->belongsTo('Mazhurnyy\Models\Table');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function logChangedData()
    {
        return $this->hasOne(LogChangedData::class, 'log_changed_id');
    }

}