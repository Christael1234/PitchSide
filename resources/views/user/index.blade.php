@extends('layouts.master')


@section('content')

<header class="masthead" style="background-image: url('{{asset('assets/img/ball.jpg')}}')">
            <div class="container position-relative px-4 px-lg-5" style="height: 40vh;">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>PitchSide</h1>
                            <span class="subheading">"Where Every Angle Counts"</span>

                           
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <h5></h5>
    <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Recent Posts Header-->
            <h1 class="text-center display-4 my-4">Recent Posts</h1>

            @foreach ($posts->sortByDesc('created_at')->take(3) as $post)
            <!-- Post preview-->
            <div class="post-preview">
                <a href="{{ route('user.details', ['post' => $post->id]) }}">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <h3 class="post-subtitle">{!! Str::limit($post->content, 150) !!}</h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#!">{{ Auth::user()->name }}</a>
                    on {{ $post->created_at->format('F j, Y') }}
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
          
            @endforeach
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4">
                <!-- Optional pagination or "Load more" button can be added here -->
            </div>
        </div>
    </div>
</div>

@endsection
