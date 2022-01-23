<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function random($count)
    {
        $Blogs = Blog::select("*")
            ->inRandomOrder()
            ->limit($count)
            ->get();

        $data['blogs'] = $Blogs;

        return response()->json(
            [
                'response_code' => '00',
                'response_message' => 'data Blogs berhasil di tampilkan',
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

        $Blog = Blog::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        if ($request->hasFile(('image'))) {
            $image = $request->file('image');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = $Blog->id . "." . $image_extension;
            $image_folder = '/photos/Blog/';
            $image_location = $image_folder . $image_name;

            try {
                $image->move(public_path(($image_folder)), $image_name);

                $Blog->update([
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
        $data['Blog'] = $Blog;

        return response()->json(
            [
                'response_code' => '00',
                'response_message' => 'data Blogs berhasil di tambahkan',
                'data' => $data
            ],
            200
        );
    }
}
