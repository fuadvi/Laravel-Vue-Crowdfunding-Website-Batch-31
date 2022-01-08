<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegeneretController extends Controller
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
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $user->otpCode()->update([
            'otp' => rand(111111, 999999),
            'valid_until' => Carbon::now()->addMinute(5)
        ]);

        return response()->json(
            [
                "response_code" => "00",
                "response_message" => "silahkan cek email",
                "data" => [
                    'user' => new UserResource($user)
                ]
            ]
        );
    }
}
