<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 01.04.2017
 * Time: 22:13
 */

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer   $log_delete_id
 * @property string    $value
 * @property LogDelete $logDelete
 */
class LogDeleteData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_delete_data';

    protected $primaryKey = 'log_delete_id';

    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logDelete()
    {
        return $this->belongsTo(LogDelete::class);
    }
}