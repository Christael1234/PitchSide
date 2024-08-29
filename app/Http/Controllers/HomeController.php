<?php

namespace App\Http\Controllers;
use App\Models\Post;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('user.index');
    }

    public function show(Post $post)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.show', compact('posts'));
    }

    public function posts()
    {
        // Fetch all posts, optionally you can add pagination here
        $posts = Post::latest()->get();

        // Return view with posts
        $posts = Post::paginate(10); 
        return view('user.posts', compact('posts'));
    }
}

