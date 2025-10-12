<!-- Start Partner Area -->
<div class="partner-area ptb-100">
    <div class="container">
        <div class="partner-bg">
            <div class="partner-slider owl-carousel owl-theme">

                @foreach(\Illuminate\Support\Facades\File::files(public_path('uploads/partners')) as $partner)


                    <div class="partner-item">

                        <img src="{{ asset('uploads/partners/'.$partner->getFilename()) }}" alt="{{ $partner->getFilenameWithoutExtension() }}"


                        style="    width: 150px;
    height: 150px;">

                    </div>


                @endforeach

            </div>
        </div>
    </div>
</div>
<!-- End Partner Area -->
