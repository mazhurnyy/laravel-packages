<?php
namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $log_changed_id
 * @property string $new
 * @property string $old
 * @property LogChanged $logChanged
 */
class LogChangedData extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'log_changed_data';

    protected $primaryKey = 'log_changed_id';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['new','old'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logChanged()
    {
        return $this->belongsTo(LogChanged::class );
    }
}
