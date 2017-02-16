<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
                $user = User::where('slug', $slug)->first();
                return view('frontend.profile-edit')->with('user', $user);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $fields = $request->all();
        $v = Validator::make($request->all(), [
            'dni' => [
                'integer',
                Rule::unique('users')->ignore($user->$id)
            ],
            'email' => [
                'email',
                Rule::unique('users')->ignore($user->$id)
            ]
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
            flash('Ha ocurrido un error, por favor verifique la información enviada.', 'warning');
        }
        $user->type = $fields['inputFormId'];
        $user->save();
        flash('El usuario se actualizó correctamente.', 'success');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
}
