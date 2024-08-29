<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage; // Correct placement here
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image_path' => ['nullable', 'image', 'max:2048'], // Allow image files up to 2MB
            'about_me' => ['nullable', 'string', 'max:1000'], 
            'country' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'instagram_profile' => ['nullable', 'string', 'max:255'],
            
        ]);
    }

    protected function create(array $data)
    {
        // Handle the file upload
        if (isset($data['image_path'])) {
            $path = $data['image_path']->store('profile_images', 'public');
        } else {
            $path = null;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image_path' => $path,
            'about_me' => $data['about_me'], 
            'country' => $data['country'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'instagram_profile' => $data['instagram_profile']
            
        ]);
    }


public function update(Request $request)
    {
        
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'image_path' => ['nullable', 'image', 'max:2048'],
            'country' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'about_me' => ['nullable', 'string', 'max:1000'],
            'instagram_profile' => ['nullable', 'string', 'max:255'],
            
        ]);

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('profile_images', 'public');
            $user->image_path = $path;
        }

        
        $user->name = $request->name;
        $user->email = $request->email;
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
}






