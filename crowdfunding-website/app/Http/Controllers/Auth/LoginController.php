<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LoginController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return response()->json(
            [
                'response_code' => "00",
                'response_message' => "user berhasil login",
                "data" =>  [
                    "token" => $token,
                    "user" => $user
                ]
            ]
        );
    }
}
