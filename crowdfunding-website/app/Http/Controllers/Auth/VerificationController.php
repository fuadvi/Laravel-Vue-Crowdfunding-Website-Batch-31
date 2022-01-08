<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class VerificationController extends Controller
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
            'otp' => 'required'
        ]);

        $otp = OtpCode::where('otp', $request->otp)->first();
        if (!$otp) {
            return response()->json(
                [
                    'response_code' => "01",
                    'response_message' => "OTP Code tidak ditemukan"
                ]
            );
        }

        $now = Carbon::now();
        if ($now > $otp->valid_until) {
            return response()->json(
                [
                    'response_code' => "01",
                    'response_message' => "OTP Code sudah expired silahkan generate ulang"
                ]
            );
        }

        $user = User::find($otp->user_id);
        $user->email_verified_at = Carbon::now();
        $user->save();

        // hapus otp setelah verifikasi email
        $otp->delete();


        return response()->json(
            [
                'response_code' => "00",
                'response_message' => "berhasil diverifikasi",
                "data" =>  [
                    "user" => Arr::except($user, ['username', 'password', 'role_id'])
                ]
            ]
        );
    }
}
