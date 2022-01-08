<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json(
            [
                "response_code" => "00",
                "response_message" => "berhasil update password",
                "data" => [
                    'user' => Arr::except($user, ['username', 'password', 'role_id'])
                ]
            ]
        );
    }
}
