<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserEvent;
use App\Mail\ConfirmAccount;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registered';

    /**
     * Create a new controller instance.
     *
     * void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:40',
            'lastname' => 'required|max:40',
            'dni' => 'unique:users',
            'passport' => 'unique:users',
            'email' => 'required|email|max:255|unique:users',
            'country_id' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'dni' => $data['dni'] ? $data['dni'] : $data['passport'],
            'passport' => $data['passport'] ? $data['passport'] : $data['dni'],
            'email' => $data['email'],
            'country_id' => $data['country_id'],
            'password' => bcrypt($data['password']),
        ]);

        $user->confirmation_code = str_random(150);
        $user->save();

        event(new NewUserEvent($user));

        return $user;
    }


    /**
     * Handle a registration request for the application.
     * This method overwrite the method in the trait
     * (dazh)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return view('auth.registered')->with('user', $user);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function confirmAccount(Request $request)
    {
        $info = $request->only('email', 'token');

        if (!$user = User::where('email', $info['email'])->where('confirmation_code', $info['token'])->where('confirmed', false)->first()) {

            if ($user = User::where('email', $info['email'])->where('confirmed', true)->first()) {

                flash('<h3>Su cuenta ya fué confirmada por favor logueese para comenzar a operar en el sitio. Gracias.</h3>', 'info');

                return redirect(route('login'));

            }

            flash('<h3>Los datos proporcionados para la confirmación son incorrectos por favor verifica el link y reinténtalo o genera un nuevo mail de confirmación haciendo clic en el botón de abajo. <br> <div class="text-center"><a href="/new_email_confirmation" class="btn btn-warning">Volver a enviar email de confirmación.</a></div></h3>', 'warning');

            return redirect(route('home'));

        }

        $user->confirmed = true;
        $user->confirmation_code = str_random(150);
        $user->save();

        flash('<h3>Su  cuenta a sido confirmada con éxito. Muchas gracias.</h3>', 'success');

        return redirect(route('login'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newEmailConfirmation()
    {
        return view('auth.new-email-confirmation');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function sendNewEmailConfirmation(Request $request)
    {
        $info = $request->only('email');

        if (!$user = User::where('email', $info['email'])->where('confirmed', false)->first()) {

            if ($user = User::where('email', $info['email'])->where('confirmed', true)->first()) {

                flash('<h3>Su cuenta ya fué confirmada por favor logueese para comenzar a operar en el sitio. Gracias.</h3>')->important();

                return redirect(route('login'));

            }

            flash('<h4>Los datos proporcionados no coinciden con ninguno de nuestros registros. Por favor registrese como usuario primero, gracias.</h4>')->warning()->important();

            return redirect(route('home.register.newEmail'));

        }

        $user->confirmation_code = str_random(150);
        $user->save();

        Mail::to($user->email, $user->formalFullname)->send(new ConfirmAccount($user));

        flash('<h3>Hemos reenviado el email de confirmación. Por favor verifique su casilla de correo, no olvide revisar la casilla de spam. Muchas gracias.')->success()->important();

        return redirect(route('login'));
    }
}
