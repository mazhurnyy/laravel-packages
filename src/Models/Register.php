<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 09.10.2017
 * Time: 23:33
 */

namespace Mazhurnyy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property string $created_at
 * @property User $user
 */
class Register extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'register';

    protected $primaryKey = 'token';

    public  $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['email', 'token', 'created_at'];

}
