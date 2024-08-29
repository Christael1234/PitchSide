

@extends('layouts.master')

@section('content')
    <header class="masthead" style="background-image: url('{{ $post->image_path ? asset('storage/' . $post->image_path) : asset('assets/img/post-bg.jpg') }}');">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <h2 class="subheading">{{ $post->subtitle }}</h2>
                        <span class="meta">
                            Posted by
                            <a href="#!">{{ Auth::user()->name }}</a>
                            on {{ $post->created_at->format('F d, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h1>{{ $post->title }}</h1>
                    {!! $post->content !!}
                    
                    <!-- Comment Section -->
                    <section class="comments mt-5">
                        <h2>Comments</h2>
                        @foreach($post->comments as $comment)
                            <div class="comment mb-3">
                                <p><strong>{{ $comment->name }}</strong> said:</p>
                                <p>{{ $comment->comment }}</p>
                                <p class="text-muted">{{ $comment->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                        @endforeach
                        
                        <hr>
                        
                        <!-- Comment Form -->
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </article>
@endsection

