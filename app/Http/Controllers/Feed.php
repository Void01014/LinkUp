<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Feed extends Controller
{
    public function view(Request $request)
    {
        $posts = Post::with('user')
                     ->with('comments')
                     ->withCount('likes')
                     ->withExists(['likes as i_liked' => function($q) {
                        $q->where('user_id', Auth::id());
                     }])
                     ->latest()
                     ->get();

        return view('feed', [
            'user' => $request->user(),
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string|max:5000',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        ], [
            'content.required' => 'Please write something before posting.',
            'content.max' => 'Post content cannot exceed 5000 characters.',
            'featured_image.image' => 'The file must be an image.',
            'featured_image.mimes' => 'Only JPEG, PNG, JPG, and GIF images are allowed.',
            'featured_image.max' => 'Image size cannot exceed 10MB.',

        ]);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        Auth::user()->posts()->create($data);

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function edit(Request $request)
    {
        return view('post_edit', [$request->post]);
    }
}
