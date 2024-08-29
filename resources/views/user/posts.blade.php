


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>All Posts - PitchSide Blog</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets3/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQe4EumY3j2zH8efEpFwYO6bo4b6F10kTDCcG1RjElTQfD6/6kI4DhUc2" crossorigin="anonymous">
    <!-- Core theme CSS (includes custom styles) -->
    <link href="{{ asset('assets3/css/styles.css') }}" rel="stylesheet" />
    <style>
        .card {
            height:400px;
            margin-bottom: 50px;
        }
        .card-img-top {
            height: 150px;
            object-fit: cover;
        }
        .card-body {
            display: flex;
            flex-direction: column;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }
        .card-text {
            flex-grow: 1;
        }
        .card:hover {
            transform: scale(1.02);
            transition: transform 0.2s;
        }
        
    </style>
</head>
<body>
    <!-- Responsive navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">PitchSide</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header -->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">All Blog Posts</h1>
                <p class="lead mb-0">Explore our latest posts and updates</p>
            </div>
        </div>
    </header>
    <!-- Page content -->
    <div class="container">
        <div class="row">
            <!-- Blog entries -->
            <div class="col-lg-8">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-md-6">
                        <div class="card">
                            <a href="{{ route('user.details', ['post' => $post->id]) }}">
                                <img class="card-img-top" src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" />
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                                <a class="btn btn-primary mt-auto" href="{{ route('user.details', ['post' => $post->id]) }}">Read More →</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        <li class="page-item {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $posts->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Newer</a>
                        </li>
                        @for ($i = 1; $i <= $posts->lastPage(); $i++)
                            <li class="page-item {{ $posts->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ !$posts->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $posts->nextPageUrl() }}">Older</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Side widgets -->
            <div class="col-lg-4">
                <!-- Search widget -->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget -->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Category 1</a></li>
                                    <li><a href="#!">Category 2</a></li>
                                    <li><a href="#!">Category 3</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Category 4</a></li>
                                    <li><a href="#!">Category 5</a></li>
                                    <li><a href="#!">Category 6</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget -->
                <div class="card mb-4">
                    <div class="card-header">Side Widget</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; PitchSide Blog 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Y5/j51I1LgITsMzRU9gG8AKd1wym" crossorigin="anonymous"></script>
    <!-- Core theme JS -->
    <script src="{{ asset('assets3/js/scripts.js') }}"></script>
</body>
</html>
