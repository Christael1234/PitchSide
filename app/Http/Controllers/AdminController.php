<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\View\View
     */
 
    

    

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
          
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'image_path' => ['nullable', 'image', 'max:2048'],
            'country' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'about_me' => ['nullable', 'string', 'max:1000'],
            'instagram_profile' => ['nullable', 'string', 'max:255'],
            
        ]);

        
        if ($request->hasFile('image_path')) {
            // Delete the old image if exists
            if ($user->image_path) {
                Storage::delete('public/' . $user->image_path);
            }
    
            // Store the new image
            $path = $request->file('image_path')->store('profile_images', 'public');
            $user->image_path = $path;
        }
        
        $user->name = $request->name;
    
       
        $user->country = $request->country;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->about_me = $request->about_me;
        $user->instagram_profile = $request->instagram_profile;
        

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        
        $user->update($data);


        return redirect()->route('profile.show')->with('status', 'Profile updated successfully.');
    }



public function profile()
{
    return view('admin.profile');
}
  
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function edit()
    {
        return view('admin.edit');
    }
    

    public function delete()
    {
        return view('admin.delete');
    }

    public function show(Post $post)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts', compact('posts'));
    }


    

    
}



