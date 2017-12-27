<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;

class AuthenticateController
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $info = $request->all();
        $user = null;
        $token = '';
        $countries = null;

        if(!$info['isAdmin'] && !empty($info['userLogged']) && empty($info['email']) && empty($info['document'])) {

            $user = User::where('email', $info['userLogged'])->first();

        } else if (empty($info['email']) && !empty($info['document'])) {

            if (!$user = User::where('dni', $info['document'])->first()) {

                if (!$user = User::where('passport', $info['document'])->first()) {

                    $user = null;

                }

            }

        } else if (!empty($info['email']) && empty($info['document'])) {

            if (!$user = User::where('email', $info['email'])->first()) {

                $user = null;

            }

        } else {

            if (!$user = User::where('dni', $info['document'])->where('email', $info['email'])->first()) {

                if (!$user = User::where('passport', $info['document'])->where('email', $info['email'])->first()) {

                    $user = null;

                }

            }
        }

        if (!empty($user)) {

            $token = JWTAuth::fromUser($user);

        }

        $countries = Country::orderBy('country')->get();

        // all good so return the token
        return response()->json(compact('token', 'user', 'countries'), 200);
    }
}