<?php

namespace App\Http\Controllers\Administration;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('isEmployed')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('deleted_at', null)->orderBy('created_at', 'desc')->paginate(10);
        $users->each(function ($users) {
            $users->country;
        });
        return view('backend.users')->with('users', $users);
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
