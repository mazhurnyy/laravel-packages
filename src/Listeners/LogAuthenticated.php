<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 01.05.2017
 * Time: 23:39
 */

namespace Mazhurnyy\Listeners;

use App\Models\User;
use Carbon;

/**
 * Class LogAuthenticated
 * действия, если пользователь авторизован,
 * @package App\Listeners
 */
class LogAuthenticated
{
    /**
     * запись в БД дату последнего визита авторизованого пользователя
     * @param $user
     */
    public function handle($user)
    {
        $current_user = User::find($user->user->id);
        $current_user->visited_at = Carbon\Carbon::now();
        $current_user->save();
    }
}