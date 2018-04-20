<?php

namespace Mazhurnyy\Http\Controllers\Auth;

use Mazhurnyy\Http\Controllers\Controller;
use App\Models\Register;
use App\Models\User;
use App\Notifications\RegisterNotifications;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    // todo НА БУДУЩЕЕ: у ссылок на регистрацию и сброс есть время жизни?
    // todo было бы не плохо его выводить в алерте об успехе отправки письма и в сбросе и в регистрации

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, Notifiable;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * @var string
     */
    protected $email = '';

    /**
     * Create a new controller instance.
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->redirectTo = '/' . \LaravelLocalization::getCurrentLocale() . '/profile';
    }

    /**
     * Форма ввода почты для продолжения
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkForm()
    {
        return view('auth.register.start');
    }

    /**
     * Начало регистрации
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendLink()
    {
        $this->email = request()->input('email');
        request()->session()->put('email', $this->email);

        $this->validator(request()->all())->validate();
        $token = Str::random(64);

        $register = Register::whereEmail($this->email)->first();

        if ($register) {
            Register::whereEmail($this->email)->update(['token' => $token]);
        } else {
            Register::create(['token' => $token, 'email' => $this->email]);
        }

        // отправляем ссылку на продолжение регистрации
        $this->notify(new RegisterNotifications($token));

        // todo проверка отправки письма??? должна быть гдето в недрах, где ??? ушло письмо или нет - хз
        request()->session()->forget('email');

        return redirect()
            ->route('register')
            ->with('status', __('status.link_to_register_success'))
            ->with('alert', 'success');
    }

    /**
     * продолжение регистрации
     *
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm($token)
    {
        $register = Register::select('email')->whereToken($token)->first();

        if ($register) {
            Auth::logout();

            return view('auth.register.completion', ['email' => $register->email, 'token' => $token]);
        } else {
            return redirect()
                ->route('register')
                ->with('status', __('status.wrong_link'))
                ->with('alert', 'danger');
        }
    }

    /**
     * окончание регистрации
     * заносим в базу имя пользователя и пароль и редирект на страницу профиля
     */
    public function concluding()
    {
        request()->session()->flash('password', request()->input('password'));
        request()->session()->flash('password_confirmation', request()->input('password_confirmation'));

        $this->validatorConcluding(request()->all())->validate();

        $register = Register::whereToken(request()->input('token'))->first();

        if ($register) {
            request()->session()->forget('password');
            request()->session()->forget('password_confirmation');

            $this->email = $register->email;
            $user = $this->create(request()->all());

            Auth::loginUsingId($user->id, true);
            Register::whereToken(request()->input('token'))->delete();

            return redirect($this->redirectPath())
                ->with('status', __('status.register_success'))
                ->with('alert', 'success');
        } else {
            return redirect()
                ->route('register.completion', ['token' => request()->input('token')])
                ->withInput(request()->only('name', 'phone', 'password', 'password_confirmation'))
                ->with('status', __('status.fail'))
                ->with('alert', 'danger');
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
        ]);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    protected function validatorConcluding(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:50',
            'phone'    => 'required|min:7|max:20|unique:users',
            'password' => 'required|confirmed|min:6|max:100',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {
        // роль по умолчанию 1 - простой пользователь
        return User::create([
            'name'     => $data['name'],
            'email'    => $this->email,
            'phone'    => $data['phone'],
            'password' => bcrypt($data['password']),
            'token'    => Str::random(64),
        ]);
    }
}
