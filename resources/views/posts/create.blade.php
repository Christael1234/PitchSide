
@extends('layouts.admin')
@section('content')



  <section class="section">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <h1 class="card-title">Create a New Post</h1>
        
          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

          <form action="{{ route('posts.store') }}" method="POST" 
          enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
              <label for="postTitle" class="form-label fw-bold">Post Title</label>
              <input type="text" class="form-control" id="postTitle"  name="title" placeholder="Enter post title">
            </div>
            

            <div class="mb-3">
    <label for="postContent" class="form-label fw-bold">Post Content</label>
    <!-- Replace textarea with a div for Quill -->
    <div id="editor" style="height: 300px;"></div>
    <!-- Hidden textarea to store Quill content -->
    <textarea class="form-control" id="postContent" name="content" style="display: none;"></textarea>
</div>
             
   
            <div class="mb-3">
              <label for="postImage" class="form-label fw-bold">Post Image</label>
              <input type="file" class="form-control" id="postImage" name="postImage" name="image_path">
            </div>
            
            <button type="submit" class="btn btn-primary">Post</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection

