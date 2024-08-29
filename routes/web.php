<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/userindex', [App\Http\Controllers\HomeController::class, 'home'])->name('user.index');



Route::get('/userindex', [App\Http\Controllers\PostController::class, 'index'])->name('user.index');





Route::middleware(['auth'])->group(function () {
    

    Route::get('/admin/dashboard', [ContactController::class, 'index2'])->name('admin.dashboard');
    
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

    Route::put('/profile', [AdminController::class, 'update'])->name('profile.update');


Route::get('/profile', [AdminController::class, 'show'])->name('profile.show');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    Route::post('posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/admin/posts', [PostController::class, 'all'])->name('admin.posts');

    Route::get('/posts/{post}', [PostController::class, 'details'])->name('user.details');

    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');



Route::get('/famousposts', [PostController::class, 'famousPosts'])->name('famousposts');

// Display a listing of contact messages
Route::get('/contacts/messages', [ContactController::class, 'index'])->name('admin.contacts');


Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

});


// Display the contact form
Route::get('/contact', [ContactController::class, 'create'])->name('user.contact');

// Store a new contact message
Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');



Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// Route to show all posts
Route::get('/allposts', [HomeController::class, 'posts'])->name('user.posts');
