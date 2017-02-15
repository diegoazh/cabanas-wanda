<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon as Carbon;

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
        $birth = Carbon::createFromFormat('Y-m-d', $user->date_of_birth);
        return view('frontend.profile-show')->with(compact('user', 'birth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = User::where('slug', $slug)->first();
        $birth = Carbon::createFromFormat('Y-m-d', $user->date_of_birth);
        return view('frontend.profile-edit')->with(compact('user', 'birth'));
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
