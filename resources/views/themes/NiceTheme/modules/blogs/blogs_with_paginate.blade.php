<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
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
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End --> 