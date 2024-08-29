<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $posts = Post::all();
        return view('user.index', compact('posts'),  ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }
   
    
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'postImage' => 'image|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('postImage')) {
        $imagePath = $request->file('postImage')->store('public/post-images');
        $imagePath = str_replace('public/', '', $imagePath);

        // Create post with user_id
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image_path = $imagePath;
       
        $post->save();
    } else {
        // Handle case where no image is uploaded
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->id(); // Assign current user's ID
        $post->save();
    }

    return redirect()->route('posts.create')->with('success', 'Post created successfully.');

}

   
    public function details(Post $post)
    {
        $posts = Post::all();
        return view('user.details', compact('posts'), ['post' => $post]);
    }

    public function all(Post $post)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts', compact('posts'));
    }


    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update the specified post in storage
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // validate the image file
        ]);

       

        if ($request->hasFile('image_path')) {
            // Delete the old image if exists
            if ($post->image_path) {
                Storage::delete('public/' . $post->image_path);
            }
    
            // Store the new image
            $path = $request->file('image_path')->store('posts', 'public');
            $post->image_path = $path;

        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'image_path' => $path, // save the file path in the database
        ]);

        return redirect()->route('admin.posts');
    }

    // // Remove the specified post from storage
    // public function destroy(Post $post)
    // {
    //     $post->delete();

    //     return redirect()->route('posts.index');
    // }

    // public function details(Post $post)
    // {
    //     return view('posts.details', compact('post'),['post' => $post->id]);
    // }
}

public function famousPosts()
{
    $posts = Post::withCount('comments')
                 ->orderByDesc('comments_count')
                 ->get();

    return view('admin.dashboard', ['posts' => $posts]);
}

}


