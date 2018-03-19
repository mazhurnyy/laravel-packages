<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 20.09.2017
 * Time: 15:03
 */

namespace Mazhurnyy\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

/**
 * разлогиниваем пользователей
 */
class ExitUser
{
    /**
     * ВЫХОД
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(){
        Auth::logout();

        return (empty(url()->previous())) ? redirect()->route('home') : redirect()->back();
    }

}