<?php

namespace Mazhurnyy\Http\Controllers\Auth;

use Mazhurnyy\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    public  $maxAttempts = 5;
    public  $decayMinutes = 10;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->redirectTo = '/' . \LaravelLocalization::getCurrentLocale() . '/profile';
    }

    protected function redirectTo()
    {
        request()->session()->forget('email');

        if (request()->session()->has('back')) {
            $back = request()->session()->get('back');
            request()->session()->forget('back');

            return $back;
        }
        else {
            return $this->redirectTo;
        }
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (\Auth::check()) {
            return redirect()->route('home');
        }

        if (url()->previous() != route('login')) {
            request()->session()->put('back', url()->previous());
        }

        return view('mazhurnyy::auth.login');
    }

    /**
     * Получите неудачный экземпляр ответа входа в систему.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        request()->session()->put('email', request()->input('email'));
        request()->session()->flash('password', request()->input('password'));

        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        // возвращаем данные в форму
        return redirect()
            ->back()
            ->withInput(request()->only('email', 'remember', 'password'))
            ->withErrors($errors);
    }
}
