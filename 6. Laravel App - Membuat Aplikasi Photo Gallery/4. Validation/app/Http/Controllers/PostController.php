<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2000',
            // mimes yaitu extension yang diperbolehkan
            // max:2000 yaitu minimal berapa size
        ]);

        $post = New Post;
        $post->description = $request->description;
        $post->user_id = auth()->id();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $file->move($destinationPath, $fileName);
            $post->image = $fileName;
        }

        $post->save();
        return back()->withMessage('Berhasil terkirim..!');
    }
}
