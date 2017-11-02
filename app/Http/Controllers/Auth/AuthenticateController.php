<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Passenger;
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
    public function authenticate(Request $request) // Fix -- also find passenger
    {
        $info = $request->all();
        $user = null;
        $passenger = null;
        $token = '';
        $countries = null;

        if(!$info['isAdmin'] && !empty($info['userLogged']) && empty($info['email']) && empty($info['document'])) {

            $user = User::where('email', $info['userLogged'])->first();

        } else if (empty($info['email']) && !empty($info['document'])) {

            $user = User::where('dni', $info['document'])->first();

            if (!$user) {

                $user = User::where('passport', $info['document'])->first();

                if (!$user) {

                    $passenger = Passenger::where('dni', $info['document'])->first();

                    if (!$passenger) {

                        $passenger = Passenger::where('passport', $info['document'])->first();

                    }

                }

            }

        } else if (!empty($info['email']) && empty($info['document'])) {

            $user = User::where('email', $info['email'])->first();

            if (!$user) {

                $passenger = Passenger::where('email', $info['email'])->first();

            }

        } else {

            $user = User::where('dni', $info['document'])->where('email', $info['email'])->first();

            if (!$user) {

                $user = User::where('passport', $info['document'])->where('email', $info['email'])->first();

                if (!$user) {

                    $passenger = Passenger::where('dni', $info['document'])->where('email', $info['email'])->first();

                    if (!$passenger) {

                        $passenger = Passenger::where('passport', $info['document'])->where('email', $info['email'])->first();

                    }

                }

            }
        }

        if (!empty($logged) || !empty($user)) {

            $token = JWTAuth::fromUser($logged ? $logged : $user);

        }

        $countries = Country::orderBy('country')->get();

        // all good so return the token
        return response()->json(compact('token', 'user', 'passenger', 'countries'), 200);
    }
}