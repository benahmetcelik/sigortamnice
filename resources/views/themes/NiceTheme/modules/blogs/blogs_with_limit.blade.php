<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="text-primary text-uppercase">Blog</h5>
            <h1 class="display-5">Son Blog Yazılarımız</h1>
        </div>
        <div class="row g-5">
            @foreach($blogs as $blog)
                <div class="col-lg-4">
                    <div class="blog-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="{{ asset($blog->image_path) }}" alt="{{ $blog->title }}">
                        </div>
                        <div class="bg-light p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>{{ optional($blog->creator)->name }}</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>{{ $blog->created_at->format('d.m.Y') }}</small>
                            </div>
                            <h4 class="mb-3">{{ $blog->title }}</h4>
                            <p>{{ Str::limit($blog->description, 100) }}</p>
                            <a class="text-uppercase" href="{{ route('blog.detail', $blog->slug) }}">Devamını Oku <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Blog End --> 