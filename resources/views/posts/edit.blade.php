@extends('layouts.admin')
@section('content')

<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Edit Post</h1>

                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="postTitle" class="form-label fw-bold">Post Title</label>
                        <input type="text" class="form-control" id="postTitle" name="title" value="{{ old('title', $post->title) }}" placeholder="Enter post title">
                    </div>

                    <div class="mb-3">
    <label for="postContent" class="form-label fw-bold">Post Content</label>
    <!-- Replace textarea with a div for Quill -->
    <div id="editor" style="height: 300px;">{!! old('content', $post->content) !!}</div>
    <!-- Hidden textarea to store Quill content -->
    <textarea class="form-control" id="postContent" name="content" style="display: none;">{!! old('content', $post->content) !!}</textarea>
</div>

                    

                    <div class="mb-3">
                        <label for="postImage" class="form-label fw-bold">Post Image</label>
                        <input type="file" class="form-control" id="postImage" name="image_path">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Post</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
