<?php

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property string $created_at
 * @property User $user
 */
class PasswordReset extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'password_resets';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['email', 'token', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'email', 'email');
    }
}
