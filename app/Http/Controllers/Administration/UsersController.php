<?php

namespace App\Http\Controllers\Administration;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (($request->search || empty($request->search)) && !$request->query('page', null)) {
            $search = $request->search;
        } else if (!empty(Cookie::get('search'))) {
            $search = Cookie::get('search');
        } else {
            $search = null;
        }

        $users = User::email($search)->orderBy('created_at', 'desc')->paginate(10);
        $users->each(function ($users) {
            $users->country;
        });

        if ($search && !empty($search)) {
            Cookie::queue('search', $search, 60, null, null, false, false);
        } else {
            Cookie::forget('search');
        }

        return view('backend.users')->with(compact('users', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = $request->all();

        $cliente = new User([
            'name' => $info['name'],
            'lastname' => $info['lastname'],
            'dni' => $info['dni'],
            'passport' => $info['passport'],
            'email' => $info['email'],
            'genre' => $info['genre'],
            'country_id' => $info['country']
        ]);

        $cliente->save();

        return response()->json(compact('cliente'), 200);
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
