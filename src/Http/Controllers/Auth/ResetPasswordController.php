<?php

namespace Mazhurnyy\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

/**
 * Class ResetPasswordController
 *
 * @package App\Http\Controllers\Auth
 */
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * перенаправление пользователя, в случае успехного сбросва пароля
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->redirectTo = '/' . \LaravelLocalization::getCurrentLocale() . '/profile';
    }

    /**
     * Форма ввода почты для продолжения
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkForm()
    {
        return view('auth.reset.start');
    }

    /**
     * Отправляем ссылку сброса данному пользователю.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendLink(Request $request)
    {
        request()->session()->put('email', request()->input('email'));

        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Успех отправки ссылки на сброс пароля.
     *
     * @param $response
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse($response)
    {
        request()->session()->forget('email');

        return redirect()
            ->route('reset')
            ->with('status', trans($response))
            ->with('alert', 'success');
    }

    /**
     * Неудача отправки ссылки сброса пароля.
     *
     * @param  \Illuminate\Http\Request
     * @param  string $response
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return redirect()
            ->route('reset')
            ->withInput(request()->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    /**
     * Validate the email for the given request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    /**
     * Форма завершения сброса пароля
     *
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm($token)
    {
        \Auth::logout();

// Illuminate\Auth\Passwords\PasswordBroker - костыль, чтобы убрать проверку ввода пароля меняе
// $credentials['password_confirmation']  на   $credentials['password]

        return view('auth.reset.completion', ['token' => $token]);
    }

    /**
     * Сбросьте пароль данного пользователя.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function concluding(Request $request)
    {
        request()->session()->flash('password', request()->input('password'));
        request()->session()->flash('password_confirmation', request()->input('password_confirmation'));

        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Здесь мы попытаемся сбросить пароль пользователя. Если это будет успешным, мы
        // будет обновлять пароль в реальной модели пользователя и
        // база данных. В противном случае мы проанализируем ошибку и вернем ответ.
        $response = $this->broker()->reset($this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            });

        // Если пароль был успешно сброшен, мы перенаправим пользователя обратно
        // домашнее аутентифицированное представление приложения. Если есть ошибка, мы можем
        // перенаправлять их обратно туда, откуда они пришли, с их сообщением об ошибке
        return $response == Password::PASSWORD_RESET ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Получите ответ для успешного сброса пароля.
     *
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse($response)
    {
        // todo какая то магия разлогинивает и кидает на вход

        request()->session()->forget('password');
        request()->session()->forget('password_confirmation');

        return redirect($this->redirectPath())
            ->with('status', trans($response))
            ->with('alert', 'success');
    }

    /**
     * Получите ответ на неудачный сброс пароля.
     *
     * @param  \Illuminate\Http\Request
     * @param  string $response
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()
            ->route('reset.completion', ['token' => request()->input('token')])
            ->withInput(request()->only('email', 'password', 'password_confirmation'))
            ->with('status', trans($response))
            ->with('alert', 'danger');
    }

    /**
     * Получите учетные данные для сброса пароля из запроса.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password', 'password_confirmation', 'token');
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password'       => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($user);
    }

    /**
     * Получите правила проверки сброса пароля.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6|max:100',
        ];
    }
}
