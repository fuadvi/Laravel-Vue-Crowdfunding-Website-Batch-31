<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        return response()->json(
            [
                "response_code" => "00",
                "response_message" => "Profile berhasil di tampilkan",
                "data" => [
                    'profile' => $user
                ]
            ]
        );
    }
}
