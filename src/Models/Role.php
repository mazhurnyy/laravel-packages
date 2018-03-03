<?php

namespace Mazhurnyy\Models;

use Mazhurnyy\Events\RoleDeleting;
use Mazhurnyy\Events\RoleSaved;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;

/**
 * @property integer $id
 * @property integer $priority
 * @property string $name
 * @property string $note
 * @property User[] $users
 */
class Role extends Model
{
    use OrderableModel;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = ['name', 'note', 'priority'];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved' => RoleSaved::class,
        'deleting' => RoleDeleting::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    /**
     * Get order field name.
     * @return string
     */
    public function getOrderField()
    {
        return 'priority';
    }
}
