<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/admin/panel';

    protected function authenticated ()
    {
        $user = Auth::user();

        if (!$user->confirmed) {

            flash('<h4><span class="text-capitalize" style="display: block"><b>Aún no has confirmado tu cuenta.</b></span> Por favor busca en tu correo el mail de confirmación que te enviamos y sigue los pasos que allí se indican para confirmar tu cuenta o genera un nuevo mail de confirmación haciendo clic en el botón de abajo Muchas gracias. <br> <div class="text-center"><a href="/new_email_confirmation" class="btn btn-warning">Volver a enviar email de confirmación.</a></div></h4>', 'danger');

            Auth::logout();
        }

        if ($user->isAdmin() || $user->isEmployed())
        {
            return redirect()->route('admin.panel');
        }
        else
        {
            return redirect()->route('home');
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
