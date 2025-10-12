@extends('themes.NiceTheme.layouts.app')

@section('title', $blog->title . ' - Nice Yazılım')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="display-4 mb-4 mb-md-0 text-white">Blog Detay</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn btn-lg btn-outline-light" href="{{ route('home') }}">Anasayfa</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-lg btn-outline-light" href="{{ route('blog') }}">Blog</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-lg btn-outline-light disabled" href="">{{ $blog->title }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Detail Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <div class="position-relative overflow-hidden mb-4">
                            <img class="img-fluid w-100" src="{{ asset($blog->image_path) }}" alt="{{ $blog->title }}">
                        </div>
                        <h1 class="mb-4">{{ $blog->title }}</h1>
                        <div class="d-flex mb-4">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>{{ optional($blog->creator)->name }}</small>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>{{ $blog->created_at->format('d.m.Y') }}</small>
                        </div>
                        <div class="mb-4">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Search Form -->
                    <div class="mb-5">
                        <form action="{{ route('blog') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Blog Ara...">
                                <button class="btn btn-primary px-4"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Category List -->
                    <div class="mb-5">
                        <h3 class="mb-4">Kategoriler</h3>
                        <div class="d-flex flex-column">
                            @foreach(\App\Models\BlogCategory::where('status', true)->get() as $category)
                                <a class="h5 mb-3" href="{{ route('blog', ['category' => $category->slug]) }}">
                                    <i class="fas fa-angle-right text-primary me-2"></i>{{ $category->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Post -->
                    <div class="mb-5">
                        <h3 class="mb-4">Son Yazılar</h3>
                        @foreach(\App\Models\Blog::where('status', true)->where('id', '!=', $blog->id)->orderBy('created_at', 'desc')->limit(5)->get() as $recentBlog)
                            <div class="d-flex mb-3">
                                <img class="img-fluid" src="{{ asset($recentBlog->image_path) }}" style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $recentBlog->title }}">
                                <a href="{{ route('blog.detail', $recentBlog->slug) }}" class="h5 d-flex align-items-center bg-light px-3 mb-0">{{ $recentBlog->title }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Detail End -->
@endsection 