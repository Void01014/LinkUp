<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Feed extends Controller
{
    public function view(Request $request)
    {
        $posts = Post::with('user')->latest()->get();

        return view('feed', [
            'user' => $request->user(),
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'featured_image' => $imagePath,
        ]);

        return back()->with('success', 'Post shared successfully!');
    }

    public function get_Latest_posts() {}

    public function get_rec() {}
}
