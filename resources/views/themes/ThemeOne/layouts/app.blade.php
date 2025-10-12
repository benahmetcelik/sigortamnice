<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('themes.ThemeOne.layouts.styles')

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ themeAssets('/') }}/assets/images/favicon.png">
    <!-- Title -->
    <title>SigortamNice</title>
</head>

<body>
<!-- Start Preloader Area -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="pl-spark-1 pl-spark-2"></div>
    </div>
</div>
<!-- End Preloader Area -->

@include('themes.ThemeOne.layouts.header')
@yield('content')



@include('themes.ThemeOne.partials.partners')
@include('themes.ThemeOne.layouts.footer')

<!-- Start Copy Right Area -->
<div class="copy-right-area bg-color">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <p>© NiceYazilim <a href="/" target="_blank">ThemeOne</a></p>
            </div>
            <div class="col-lg-6">
                <ul>
                    <li>
                        <a href="privacy-policy.html">Privacy policy</a>
                    </li>
                    <li>
                        <a href="terms-conditions.html">Terms conditions</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Copy Right Area -->

<!-- Start Go Top Area -->
<div class="go-top">
    <i class="ri-arrow-up-s-fill"></i>
    <i class="ri-arrow-up-s-fill"></i>
</div>
<!-- End Go Top Area -->

@include('themes.ThemeOne.layouts.scripts')
</body>

</html>
