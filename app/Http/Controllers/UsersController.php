<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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

        flash('El usuario fue eliminado exitosamente.', 'success');

        if ($request->ajax()) {

            return response()->json([
                'message' => 'El usuario fue eliminado exitosamente.'
            ]);

        }

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

        return view('frontend.profile-rentals')->with(['user' => Auth::user()]);
    }

    public function myRentals($token)
    {

    }
}
