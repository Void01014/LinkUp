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
        $validated = $request->validate([
            'content' => 'required|string|max:5000',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], [
            'content.required' => 'Please write something before posting.',
            'content.max' => 'Post content cannot exceed 5000 characters.',
            'featured_image.image' => 'The file must be an image.',
            'featured_image.mimes' => 'Only JPEG, PNG, JPG, and GIF images are allowed.',
            'featured_image.max' => 'Image size cannot exceed 10MB.',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $validated['content'];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
            $post->featured_image = $imagePath;
        }

        $post->save();

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function edit(Request $request)
    {
        return view('post_edit', [$request->post]);
    }
}
