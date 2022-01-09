<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UpdateProfileController extends Controller
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

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $thumbnainame = $user->nama . "." . $photo->getClientOriginalExtension();

            $lokasiFolder = 'Profile/photo/';
            $photo->move($lokasiFolder, $thumbnainame);
        }

        $user->update([
            'nama' => $request->nama,
            'photo' => $thumbnainame
        ]);
        $user['photo'] = '/Profile/photo/' . $thumbnainame;

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
