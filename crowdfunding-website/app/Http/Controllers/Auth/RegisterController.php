<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);

        $user->otpCode()->create([
            'user_id' => $user->id,
            'otp' => rand(111111, 999999),
            'valid_until' => Carbon::now()->addMinute(5)
        ]);

        UserRegisterEvent::dispatch($user);
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
