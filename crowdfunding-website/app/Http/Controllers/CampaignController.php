<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function index()
    {
        $campaigns = Campaign::paginate(6);
        $data['campaigns'] = $campaigns;

        return response()->json(
            [
                'response_code' => '00',
                'response_message' => 'data campaigns berhasil di tampilkan',
                'data' => $data
            ],
            200
        );
    }

    public function detail($id)
    {
        $campaign = Campaign::find($id);
        $data['campaign'] = $campaign;

        return response()->json(
            [
                'response_code' => '00',
                'response_message' => 'data campaigns detail berhasil di tampilkan',
                'data' => $data
            ],
            200
        );
    }

    public function random($count)
    {
        $campaigns = Campaign::select("*")
            ->inRandomOrder()
            ->limit($count)
            ->get();

        $data['campaigns'] = $campaigns;

        return response()->json(
            [
                'response_code' => '00',
                'response_message' => 'data campaigns berhasil di tampilkan',
                'data' => $data
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $campaign = Campaign::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        if ($request->hasFile(('image'))) {
            $image = $request->file('image');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = $campaign->id . "." . $image_extension;
            $image_folder = '/photos/campaign/';
            $image_location = $image_folder . $image_name;

            try {
                $image->move(public_path(($image_folder)), $image_name);

                $campaign->update([
                    'image' => $image_location
                ]);
            } catch (\Throwable $th) {
                return response()->json(
                    [
                        'response_code' => '01',
                        'response_message' => 'photo profil gagal upload',
                    ],
                    200
                );
            }
        }
        $data['campaign'] = $campaign;

        return response()->json(
            [
                'response_code' => '00',
                'response_message' => 'data campaigns berhasil di tambahkan',
                'data' => $data
            ],
            200
        );
    }

    public function search($keyword)
    {
        $campaigns = Campaign::where('title', 'LIKE', '%' . $keyword . '%')->get();
        $data['campaigns'] = $campaigns;

        return response()->json(
            [
                'response_code' => '00',
                'response_message' => 'data campaigns berhasil di tampilkan',
                'data' => $data
            ],
            200
        );
    }
}
