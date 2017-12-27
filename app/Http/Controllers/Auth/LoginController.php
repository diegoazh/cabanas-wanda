<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/';

    protected function authenticated ()
    {
//        $user = Auth::user();

        if (!Auth::user()->confirmed) {

            flash('<h4><span class="text-capitalize" style="display: block"><b>Aún no has confirmado tu cuenta.</b></span> Por favor busca en tu correo el mail de confirmación que te enviamos y sigue los pasos que allí se indican para confirmarla o solicita un nuevo mail de confirmación con la opción de abajo.</h4>')->error()->important();

            $email = Auth::user()->email;

            Auth::logout();

            return redirect('/new_email_confirmation')->with('email', $email);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
