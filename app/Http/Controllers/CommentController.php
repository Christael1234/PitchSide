<?php

// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        Comment::create($request->all());

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
