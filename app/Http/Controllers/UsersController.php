<?php

namespace App\Http\Controllers;

use App\Rental;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon as Carbon;
use JWTAuth;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('frontend.profile-show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (Auth::check())
        {
            if (Auth::user()->slug === $slug)
            {
                return view('frontend.profile-edit')->with('user', Auth::user());
            }
            else
            {
                return redirect()->route('home');
            }
        }
        else
        {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->first();
        $fields = $request->all();
        $v = Validator::make($fields, [
            'dni' => [
                'integer',
                Rule::unique('users')->ignore($user->id)
            ],
            'email' => [
                'email',
                Rule::unique('users')->ignore($user->id)
            ]
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
            flash('Ha ocurrido un error, por favor verifique la información enviada.', 'warning');
        }
        if (!empty($fields['name']))
            $user->name = $fields['name'];
        if (!empty($fields['lastname']))
            $user->lastname = $fields['lastname'];
        if (!empty($fields['dateOfBirth'])) {
            $dateOfBirth = Carbon::createFromFormat('d/m/Y', $fields['dateOfBirth']);
            $user->dateOfBirth = $dateOfBirth->toDateTimeString();
        }
        if (!empty($fields['genre']))
            $user->genre = $fields['genre'];
        if (!empty($fields['passport']))
            $user->passport = $fields['passport'];
        if (!empty($fields['celphone']))
            $user->celphone = $fields['celphone'];
        if (!empty($fields['phone']))
            $user->phone = $fields['phone'];
        if (!empty($fields['address']))
            $user->address = $fields['address'];
        if (isset($fields['image_avatar']) && !empty($fields['image_avatar']))
        {
            $user->imageProfile = $fields['image_avatar'];
        }
        elseif (isset($fields['imageProfile']) && !empty($fields['imageProfile']))
        {
            $user->imageProfile = $user->addAndRemoveImageProfile($fields['imageProfile'], $user);
        }
        $user->save();
        flash('El usuario <strong>' . $user->formalFullname . '</strong> se actualizó correctamente.', 'success');
        return redirect()->route('home.profile.show', $user->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = User::find($id);
        $user->delete();

        if ($request->ajax()) {

            return response()->json([
                'message' => 'El usuario fue eliminado exitosamente.'
            ]);

        }

        flash('El usuario fue eliminado exitosamente.', 'success');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function profileRentals($slug)
    {
        if (!Auth::check()) {

            return redirect(route('login'));

        }

        if (Auth::user()->slug !== $slug) {

            Auth::logout();
            return redirect(route('login'));

        }

        $token = JWTAuth::fromUser(Auth::user());

        Cookie::queue('info_one', $token, 180, null, null, false, false);

        return view('frontend.profile-rentals')->with(['user' => Auth::user()]);
    }

    public function myRentals(Request $request)
    {
        if (!$token = $request->query('token', null)) {

            flash('<h3>No hemos podido identificarlo por favor ingrese sus credenciales y vuelva a intentarlo. Muchas gracias.</h3>')->warning();

            return redirect(route('login'));
        }

        if (!$user = JWTAuth::parseToken()->authenticate()) {

            return response()->json(['message' => 'No hemos podido identificar al usuario, es posible que el token no sea válido. Por favor recargue nuevamente esta página o vuelva a loguearse. Muchas gracias.'], 404);

        }

        $rentals = Rental::where('user_id', $user->id)->orderBy('dateFrom', 'desc')->get();

        foreach ($rentals as $rental) {
            $rental->cottage;
        }

        return response()->json(compact('rentals'), 200);
    }

    public function passwordChange()
    {
        if (!Auth::check()) {
            return redirect(route('home'));
        }

        return view('frontend.password-change');
    }

    public function passwordReset(Request $request)
    {
        if (!Hash::check($request->password, Auth::user()->password)) {

            flash('<h3>Las contraseña actual no es correcta</h3>')->error()->important();

            return back(301);

        }

        if ($request->passwordNew !== $request->password_confirmation) {

            flash('<h3>Las contraseña no coinciden, por favor verifiquelo y reintente</h3>')->error()->important();

            return back(301);

        }

        Auth::user()->fill(['password' => Hash::make($request->passwordNew)])->save();

        flash('<h3>La contraseña se cambió correctamente</h3>')->success()->important();

        return redirect(route('home.profile.show', Auth::user()->slug));
    }

}
