<!-- Carousel Start -->
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img class="w-100" src="{{ asset($slider->image) }}" alt="{{ $slider->title }}">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ $slider->title }}</h1>
                            <p class="mb-4 text-white">{{ $slider->description }}</p>
                            @if($slider->button_text && $slider->button_link)
                                <a href="{{ $slider->button_link }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">{{ $slider->button_text }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->
